<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\Tests\Wikilink;

use Semmelsamu\CommonmarkExtensions\Tests\CommonMarkTest;
use Semmelsamu\CommonmarkExtensions\Wikilink\WikilinkExtension;

class WikilinkResolveTest extends CommonMarkTest
{
    protected function setUp(): void
    {
        parent::configureEnvironment(extensions: [new WikilinkExtension], config: [
            'wikilink' => [
                'resolve' => function (string $wikilink) {
                    return 'resolved:'.$wikilink;
                },
            ],
        ]);
    }

    public function test_resolved_wikilink(): void
    {
        $markdown = <<<'MARKDOWN'
        [[Test]]
        MARKDOWN;

        $expected = <<<'HTML'
        <p><a href="resolved:Test">Test</a></p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }
}
