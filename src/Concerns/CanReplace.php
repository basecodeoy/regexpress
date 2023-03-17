<?php

declare(strict_types=1);

namespace PreemStudio\RegExpress\Concerns;

use Spatie\Regex\ReplaceResult;

trait CanReplace
{
    public function replace(string|array|callable $replacement, string|array $subject, int $limit = -1): ReplaceResult
    {
        return ReplaceResult::for($this->toRegExp(), $replacement, $subject, $limit);
    }
}
