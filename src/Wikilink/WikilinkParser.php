<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\Wikilink;

use League\CommonMark\Environment\EnvironmentAwareInterface;
use League\CommonMark\Environment\EnvironmentInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class WikilinkParser implements InlineParserInterface, EnvironmentAwareInterface
{
    private $resolveWikilink;

    private $slugNormalizer;

    public function __construct(callable $resolveWikilink)
    {
        $this->resolveWikilink = $resolveWikilink;
    }

    public function setEnvironment(EnvironmentInterface $environment): void
    {
        $this->slugNormalizer = $environment->getSlugNormalizer();
    }

    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex('\[\[([^\]\|]+)(?:\|([^\]]+))?\]\]');
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $wikilink = $inlineContext->getSubMatches()[0];
        $caption = $inlineContext->getSubMatches()[1] ?? null;

        $parts = explode('#', $wikilink, 2);
        $filename = $parts[0];
        $anchor = $parts[1] ?? null;

        if ($anchor) {
            $normalizedAnchor = $this->slugNormalizer->normalize($anchor);
        }

        if ($filename) {
            $resolvedWikilink = ($this->resolveWikilink)($filename);

            if ($anchor) {
                $resolvedWikilink .= '#' . $normalizedAnchor;
            }

            if (!$caption) {
                $caption = $filename;

                if ($anchor) {
                    $caption .= ' > ' . $anchor;
                }
            }
        } else if ($anchor) {
            $resolvedWikilink = "#" . $normalizedAnchor;
            $caption = $anchor;
        } else {
            $resolvedWikilink = '';
        }

        $inlineContext->getContainer()->appendChild(new Link($resolvedWikilink, $caption));

        $inlineContext->getCursor()->advanceBy($inlineContext->getFullMatchLength());

        return true;
    }
}
