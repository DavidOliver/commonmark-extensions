<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\Tests\LaTex;

use Semmelsamu\CommonmarkExtensions\LaTex\LaTexExtension;
use Semmelsamu\CommonmarkExtensions\Tests\CommonMarkTest;

class LaTexTest extends CommonMarkTest
{
    protected function setUp(): void
    {
        parent::configureEnvironment(extensions: [new LaTexExtension]);
    }

    public function test_inline_latex(): void
    {
        $markdown = <<<'MARKDOWN'
        $E = mc^2$
        MARKDOWN;

        $expected = <<<'HTML'
        <p>
            <span class="latex-inline">$E = mc^2$</span>
        </p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_inline_latex_with_context(): void
    {
        $markdown = <<<'MARKDOWN'
        The famous equation $E = mc^2$ was proposed by Einstein.
        MARKDOWN;

        $expected = <<<'HTML'
        <p>
            The famous equation <span class="latex-inline">$E = mc^2$</span> was proposed by Einstein.
        </p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_block_latex(): void
    {
        $markdown = <<<'MARKDOWN'
        $$
        \begin{align*}
        E &= mc^2 \\
        F &= ma
        \end{align*}
        $$
        MARKDOWN;

        $expected = <<<'HTML'
        <div class="latex-block">
        $$
        \begin{align*}
        E &= mc^2 \\
        F &= ma
        \end{align*}
        $$
        </div>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_block_latex_with_context(): void
    {
        $markdown = <<<'MARKDOWN'
        Here are some equations:

        $$
        \begin{align*}
        E &= mc^2 \\
        F &= ma
        \end{align*}
        $$

        These are fundamental physics equations.
        MARKDOWN;

        $expected = <<<'HTML'
        <p>Here are some equations:</p>
        <div class="latex-block">
        $$
        \begin{align*}
        E &= mc^2 \\
        F &= ma
        \end{align*}
        $$
        </div>
        <p>These are fundamental physics equations.</p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_mixed_latex(): void
    {
        $markdown = <<<'MARKDOWN'
        The equation $E = mc^2$ is part of a larger set of equations:

        $$
        \begin{align*}
        E &= mc^2 \\
        F &= ma
        \end{align*}
        $$
        MARKDOWN;

        $expected = <<<'HTML'
        <p>The equation <span class="latex-inline">$E = mc^2$</span> is part of a larger set of equations:</p>
        <div class="latex-block">
        $$
        \begin{align*}
        E &= mc^2 \\
        F &= ma
        \end{align*}
        $$
        </div>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }

    public function test_latex_with_markdown_symbols(): void
    {
        $markdown = <<<'MARKDOWN'
        We subscript the base as follows: $361_{10}$, $\mathrm{C2FA}_{16}$, $01001011_{2}$
        MARKDOWN;

        $expected = <<<'HTML'
        <p>
            We subscript the base as follows: <span class="latex-inline">$361_{10}$</span>, <span class="latex-inline">$\mathrm{C2FA}_{16}$</span>, <span class="latex-inline">$01001011_{2}$</span>
        </p>
        HTML;

        $this->assertMarkdown($expected, $markdown);
    }
}
