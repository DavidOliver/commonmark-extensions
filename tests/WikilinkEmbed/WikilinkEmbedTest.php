<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\Tests\WikilinkEmbed;

use Semmelsamu\CommonmarkExtensions\Tests\CommonMarkTest;
use Semmelsamu\CommonmarkExtensions\WikilinkEmbed\WikilinkEmbedExtension;

class WikilinkEmbedTest extends CommonMarkTest
{
    protected function setUp(): void
    {
        parent::configureEnvironment(extensions: [new WikilinkEmbedExtension]);
    }

    public function test_basic_embed(): void
    {
        $markdown = <<<'MARKDOWN'
        ![[document.pdf]]
        MARKDOWN;

        $expected = <<<'HTML'
        <iframe src="document.pdf"></iframe>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_embed_with_caption(): void
    {
        $markdown = <<<'MARKDOWN'
        ![[document.pdf|View PDF Document]]
        MARKDOWN;

        $expected = <<<'HTML'
        <iframe src="document.pdf" title="View PDF Document"></iframe>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }
}
