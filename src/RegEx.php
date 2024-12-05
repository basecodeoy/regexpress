<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\RegEx;

final class RegEx
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
