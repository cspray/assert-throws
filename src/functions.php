<?php declare(strict_types=1);

namespace Cspray\AssertThrows;

use Throwable;

/**
 * {@see ThrowableAssert::assertThrows()}
 *
 * @param callable $throwingCallable
 * @return Throwable
 */
function assertThrows(callable $throwingCallable) : Throwable {
    return ThrowableAssert::assertThrows($throwingCallable);
}

/**
 * {@see ThrowableAssert::assertThrowsExceptionType()}
 *
 * @template ThrownType of Throwable
 * @param class-string<ThrownType> $exceptionType
 * @param callable $throwingCallable
 * @return ThrownType
 */
function assertThrowsExceptionType(string $exceptionType, callable $throwingCallable) : Throwable {
    return ThrowableAssert::assertThrowsExceptionType($exceptionType, $throwingCallable);
}

/**
 * {@see ThrowableAssert::assertThrowsExceptionTypeWithMessage()}
 *
 * @template ThrownType of Throwable
 * @param class-string<ThrownType> $exceptionType
 * @param string $message
 * @param callable $throwingCallable
 * @return ThrownType
 */
function assertThrowsExceptionTypeWithMessageIsOrContains(string $exceptionType, string $message, callable $throwingCallable) : Throwable {
    return ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains($exceptionType, $message, $throwingCallable);
}

/**
 * {@see ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex()}
 *
 * @template ThrownType of Throwable
 * @param class-string<ThrownType> $exceptionType
 * @param non-empty-string $messageRegex
 * @param callable $throwingCallable
 * @return ThrownType
 */
function assertThrowsExceptionTypeWithMessageMatchesRegex(
    string $exceptionType,
    string $messageRegex,
    callable $throwingCallable,
) : Throwable {
    return ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex(
        $exceptionType,
        $messageRegex,
        $throwingCallable,
    );
}
