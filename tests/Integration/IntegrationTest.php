<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\Tests\Callout;

use League\CommonMark\Extension\Table\TableExtension;
use Semmelsamu\CommonmarkExtensions\Callout\CalloutExtension;
use Semmelsamu\CommonmarkExtensions\CodeHighlighting\CodeHighlightingExtension;
use Semmelsamu\CommonmarkExtensions\LaTex\LaTexExtension;
use Semmelsamu\CommonmarkExtensions\Tests\CommonMarkTest;
use Semmelsamu\CommonmarkExtensions\Wikilink\WikilinkExtension;
use Semmelsamu\CommonmarkExtensions\WikilinkEmbed\WikilinkEmbedExtension;

class IntegrationTest extends CommonMarkTest
{
    protected function setUp(): void
    {
        parent::configureEnvironment(
            extensions: [
                new CalloutExtension,
                new CodeHighlightingExtension,
                new LaTexExtension,
                new WikilinkExtension,
                new WikilinkEmbedExtension,
                new TableExtension,
            ],
            config: [
                'slug_normalizer' => [
                    'unique' => false,
                ],
            ]
        );
    }

    protected function assertMarkdownFile(string $filePath): void
    {
        $markdownFile = __DIR__.'/Files/'.$filePath.'.md';
        $htmlFile = __DIR__.'/Files/'.$filePath.'.html';

        if (! file_exists($markdownFile)) {
            $this->fail("Markdown file not found for file: $filePath");

            return;
        }

        if (! file_exists($htmlFile)) {
            $this->fail("HTML file not found for file: $filePath");

            return;
        }

        $expected = file_get_contents($htmlFile);
        $markdown = file_get_contents($markdownFile);

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_vektor(): void
    {
        $this->assertMarkdownFile('Vektor');
    }

    public function test_avl(): void
    {
        $this->assertMarkdownFile('AVL-Bäume');
    }
}
