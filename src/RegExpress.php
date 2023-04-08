<?php

declare(strict_types=1);

namespace PreemStudio\RegExpress;

final class RegExpress
{
    use Concerns\CanTest;
    use Concerns\CanReplace;
    use Concerns\CanMatch;
    use Concerns\HasPattern;

    public static function make(): static
    {
        return new self();
    }
}
