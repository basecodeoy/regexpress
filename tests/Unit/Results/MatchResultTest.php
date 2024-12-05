<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Results;

use BaseCodeOy\RegEx\RegEx;
use Spatie\Regex\MatchResult;

it('should return an instance', function (): void {
    expect(RegEx::make()->digit()->match('123'))->toBeInstanceOf(MatchResult::class);
});

it('should determine if there is a match', function (): void {
    expect(RegEx::make()->digit()->match('123')->hasMatch())->toBeTrue();
    expect(RegEx::make()->digit()->match('a')->hasMatch())->toBeFalse();
});

it('should get the result', function (): void {
    expect(RegEx::make()->digit()->match('123')->result())->toBe('1');
});

it('should get the default value if there is no match', function (): void {
    expect(RegEx::make()->digit()->match('a')->resultOr('default'))->toBe('default');
});

it('should get the the first group', function (): void {
    expect(RegEx::make()->digit()->match('123')->group(0))->toBe('1');
});

it('should get the default group if there is no match', function (): void {
    expect(RegEx::make()->digit()->match('a')->groupOr(0, 'default'))->toBe('default');
});
