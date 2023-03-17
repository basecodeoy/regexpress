<?php

declare(strict_types=1);

namespace Tests\Unit\Results;

use PreemStudio\RegExpress\RegExpress;
use Spatie\Regex\MatchResult;

it('should return an instance', function () {
    expect(RegExpress::make()->digit()->match('123'))->toBeInstanceOf(MatchResult::class);
});

it('should determine if there is a match', function () {
    expect(RegExpress::make()->digit()->match('123')->hasMatch())->toBeTrue();
    expect(RegExpress::make()->digit()->match('a')->hasMatch())->toBeFalse();
});

it('should get the result', function () {
    expect(RegExpress::make()->digit()->match('123')->result())->toBe('1');
});

it('should get the default value if there is no match', function () {
    expect(RegExpress::make()->digit()->match('a')->resultOr('default'))->toBe('default');
});

it('should get the the first group', function () {
    expect(RegExpress::make()->digit()->match('123')->group(0))->toBe('1');
});

it('should get the default group if there is no match', function () {
    expect(RegExpress::make()->digit()->match('a')->groupOr(0, 'default'))->toBe('default');
});
