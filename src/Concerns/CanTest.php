<?php

declare(strict_types=1);

namespace PreemStudio\RegExpress\Concerns;

trait CanTest
{
    public function test(string $string): bool
    {
        return (bool) \preg_match($this->toRegExp(), $string);
    }
}
