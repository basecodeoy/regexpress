<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\RegEx\RegEx;
use Spatie\Regex\MatchAllResult;

it('should return an instance', function (): void {
    expect(RegEx::make()->digit()->matchAll('123'))->toBeInstanceOf(MatchAllResult::class);
});

it('should determine if there are many matches', function (): void {
    expect(RegEx::make()->digit()->matchAll('123')->hasMatch())->toBeTrue();
    expect(RegEx::make()->digit()->matchAll('a')->hasMatch())->toBeFalse();
});
