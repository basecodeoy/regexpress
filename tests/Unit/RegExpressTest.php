<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\RegEx\RegEx;

it('adds start of line', function (): void {
    expect(RegEx::make()->startOfLine()->toRegExp())->toBe('/^/');
});

it('adds end of line', function (): void {
    expect(RegEx::make()->endOfLine()->toRegExp())->toBe('/$/');
});

it('adds then', function (): void {
    expect(RegEx::make()->then('abc')->toRegExp())->toBe('/abc/');
});

it('adds find', function (): void {
    expect(RegEx::make()->find('\d')->toRegExp())->toBe('/\d/');
});

it('adds maybe', function (): void {
    expect(RegEx::make()->maybe('xyz')->toRegExp())->toBe('/(?:xyz)?/');
});

it('adds or', function (): void {
    expect(RegEx::make()->startOfLine()->or('abc')->toRegExp())->toBe('/^|abc/');
});

it('adds anything', function (): void {
    expect(RegEx::make()->anything()->toRegExp())->toBe('/.*/');
});

it('adds anythingBut', function (): void {
    expect(RegEx::make()->anythingBut('\d')->toRegExp())->toBe('/(?:[^\d]*)/');
});

it('adds something', function (): void {
    expect(RegEx::make()->something()->toRegExp())->toBe('/.+/');
});

it('adds somethingBut', function (): void {
    expect(RegEx::make()->somethingBut('\d')->toRegExp())->toBe('/(?:[^\d]+)/');
});

it('adds anyOf', function (): void {
    expect(RegEx::make()->anyOf('abc')->toRegExp())->toBe('/[abc]/');
});

it('adds any', function (): void {
    expect(RegEx::make()->any()->toRegExp())->toBe('/./');
});

it('adds not', function (): void {
    expect(RegEx::make()->not('\d')->toRegExp())->toBe('/(?!\\d)/');
});

it('adds range', function (): void {
    expect(RegEx::make()->range('a', 'z')->toRegExp())->toBe('/[a-z]/');
});

it('adds lineBreak', function (): void {
    expect(RegEx::make()->lineBreak()->toRegExp())->toBe("/(?:\r\n|\r|\n)/");
});

it('adds br (alias of lineBreak)', function (): void {
    expect(RegEx::make()->br()->toRegExp())->toBe("/(?:\r\n|\r|\n)/");
});

it('adds tab', function (): void {
    expect(RegEx::make()->tab()->toRegExp())->toBe("/\t/");
});

it('adds word', function (): void {
    expect(RegEx::make()->word()->toRegExp())->toBe('/\w/');
});

it('adds digit', function (): void {
    expect(RegEx::make()->digit()->toRegExp())->toBe('/\d/');
});

it('adds whitespace', function (): void {
    expect(RegEx::make()->whitespace()->toRegExp())->toBe('/\s/');
});

it('adds modifier', function (): void {
    expect(RegEx::make()->addModifier('i')->toRegExp())->toBe('/(?i)/');
});

it('removes modifier', function (): void {
    expect(RegEx::make()->removeModifier('m')->toRegExp())->toBe('/(?m-)/');
});

it('adds withAnyCase', function (): void {
    expect(RegEx::make()->withAnyCase()->toRegExp())->toBe('/(?i)/');
});

it('adds stopAtFirst', function (): void {
    expect(RegEx::make()->stopAtFirst()->toRegExp())->toBe('/(?U-)/');
});

it('adds searchOneLine', function (): void {
    expect(RegEx::make()->searchOneLine()->toRegExp())->toBe('/(?m-)/');
});

it('adds repeatPrevious', function (): void {
    expect(RegEx::make()->digit()->repeatPrevious()->toRegExp())->toBe('/\d+/');
});

it('adds oneOrMore', function (): void {
    expect(RegEx::make()->digit()->oneOrMore()->toRegExp())->toBe('/\d+/');
});

it('adds multiple', function (): void {
    expect(RegEx::make()->digit()->multiple(2, 5)->toRegExp())->toBe('/\d{2,5}/');
});

it('adds beginCapture', function (): void {
    expect(RegEx::make()->beginCapture()->toRegExp())->toBe('/(/');
});

it('adds endCapture', function (): void {
    expect(RegEx::make()->endCapture()->toRegExp())->toBe('/)/');
});

it('generates final regex pattern', function (): void {
    expect(RegEx::make()->startOfLine()->then('abc')->endOfLine()->toRegExp())->toBe('/^'.\preg_quote('abc', '/').'$/');
});

it('should generate a regular expression pattern', function (): void {
    expect(
        RegEx::make()
            ->startOfLine()
            ->then('http')
            ->maybe('s')
            ->then('://')
            ->maybe('www.')
            ->anythingBut(' ')
            ->endOfLine()
            ->toRegExp(),
    )->toBe('/^http(?:s)?\:\/\/(?:www.)?(?:[^ ]*)$/');
});

it('should test and return `true` for a matching value', function (): void {
    expect(
        RegEx::make()
            ->startOfLine()
            ->then('http')
            ->maybe('s')
            ->then('://')
            ->maybe('www.')
            ->anythingBut(' ')
            ->endOfLine()
            ->test('https://www.google.com'),
    )->toBeTrue();
});

it('should test and return `false` for a mismatching value', function (): void {
    expect(
        RegEx::make()
            ->startOfLine()
            ->then('http')
            ->maybe('s')
            ->then('://')
            ->maybe('www.')
            ->anythingBut(' ')
            ->endOfLine()
            ->test('junk'),
    )->toBeFalse();
});
