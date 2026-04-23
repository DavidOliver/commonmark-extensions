<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\Tests\Wikilink;

use Semmelsamu\CommonmarkExtensions\Tests\CommonMarkTest;
use Semmelsamu\CommonmarkExtensions\Wikilink\WikilinkExtension;

class WikilinkTest extends CommonMarkTest
{
    protected function setUp(): void
    {
        parent::configureEnvironment(extensions: [new WikilinkExtension]);
    }

    public function test_basic_wikilink(): void
    {
        $markdown = <<<'MARKDOWN'
        [[Test]]
        MARKDOWN;

        $expected = <<<'HTML'
        <p><a href="Test">Test</a></p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_basic_wikilink_with_context(): void
    {
        $markdown = <<<'MARKDOWN'
        This is a [[Wikilink]]!
        MARKDOWN;

        $expected = <<<'HTML'
        <p>This is a <a href="Wikilink">Wikilink</a>!</p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_wikilink_with_text(): void
    {
        $markdown = <<<'MARKDOWN'
        [[Test|Link Text]]
        MARKDOWN;

        $expected = <<<'HTML'
        <p><a href="Test">Link Text</a></p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_wikilink_with_text_and_context(): void
    {
        $markdown = <<<'MARKDOWN'
        This is a [[Test|Link Text]]!
        MARKDOWN;

        $expected = <<<'HTML'
        <p>This is a <a href="Test">Link Text</a>!</p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }
}
