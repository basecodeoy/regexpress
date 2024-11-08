<?php

declare(strict_types=1);

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
