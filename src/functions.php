<?php declare(strict_types=1);

namespace Cspray\AssertThrows;

use Throwable;

/**
 * {@see ThrowableAssert::assertThrows()}
 *
 * @param callable $actual
 * @return Throwable
 */
function assertThrows(callable $actual) : Throwable {
    return ThrowableAssert::assertThrows($actual);
}

/**
 * {@see ThrowableAssert::assertThrowsExceptionType()}
 *
 * @template ThrownType of Throwable
 * @param class-string<ThrownType> $expectedException
 * @param callable $actual
 * @return ThrownType
 */
function assertThrowsExceptionType(string $expectedException, callable $actual) : Throwable {
    return ThrowableAssert::assertThrowsExceptionType($expectedException, $actual);
}

/**
 * {@see ThrowableAssert::assertThrowsExceptionTypeWithMessage()}
 *
 * @template ThrownType of Throwable
 * @param class-string<ThrownType> $expectedException
 * @param string $expectedMessage
 * @param callable $actual
 * @return ThrownType
 */
function assertThrowsExceptionTypeWithMessageIsOrContains(
    string $expectedException,
    string $expectedMessage,
    callable $actual,
) : Throwable {
    return ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains($expectedException, $expectedMessage, $actual);
}

/**
 * {@see ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex()}
 *
 * @template ThrownType of Throwable
 * @param class-string<ThrownType> $expectedException
 * @param non-empty-string $expectedMessageRegex
 * @param callable $actual
 * @return ThrownType
 */
function assertThrowsExceptionTypeWithMessageMatchesRegex(
    string $expectedException,
    string $expectedMessageRegex,
    callable $actual,
) : Throwable {
    return ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex(
        $expectedException,
        $expectedMessageRegex,
        $actual,
    );
}
