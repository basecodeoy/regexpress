<?php

declare(strict_types=1);

namespace Tests\Unit;

use PreemStudio\RegExpress\RegExpress;
use Spatie\Regex\MatchAllResult;

it('should return an instance', function (): void {
    expect(RegExpress::make()->digit()->matchAll('123'))->toBeInstanceOf(MatchAllResult::class);
});

it('should determine if there are many matches', function (): void {
    expect(RegExpress::make()->digit()->matchAll('123')->hasMatch())->toBeTrue();
    expect(RegExpress::make()->digit()->matchAll('a')->hasMatch())->toBeFalse();
});
