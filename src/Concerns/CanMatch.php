<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\RegExpress\Concerns;

use Spatie\Regex\MatchAllResult;
use Spatie\Regex\MatchResult;

trait CanMatch
{
    public function match(string $subject): MatchResult
    {
        return MatchResult::for($this->toRegExp(), $subject);
    }

    public function matchAll(string $subject): MatchAllResult
    {
        return MatchAllResult::for($this->toRegExp(), $subject);
    }
}
