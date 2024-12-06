<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\RegEx\Concerns;

use Spatie\Regex\ReplaceResult;

trait CanReplace
{
    public function replace(string|array|callable $replacement, string|array $subject, int $limit = -1): ReplaceResult
    {
        return ReplaceResult::for($this->toRegExp(), $replacement, $subject, $limit);
    }
}
