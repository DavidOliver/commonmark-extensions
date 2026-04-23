<?php

declare(strict_types=1);

namespace Semmelsamu\CommonmarkExtensions\LaTex;

use League\CommonMark\Node\Inline\AbstractInline;

class LaTexInline extends AbstractInline
{
    public function __construct(private string $expression) {}

    public function getExpression(): string
    {
        return $this->expression;
    }
}
