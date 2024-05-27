<?php declare(strict_types=1);

namespace Cspray\AssertThrows;

use Throwable;

trait ThrowableAssertTestCaseMethods {
    public static function assertThrows(callable $throwingCallable) : Throwable {
        return ThrowableAssert::assertThrows($throwingCallable);
    }

    /**
     * @template ThrownType of Throwable
     * @param callable $throwingCallable
     * @param class-string<ThrownType> $exceptionType
     * @return ThrownType
     */
    public static function assertThrowsExceptionType(callable $throwingCallable, string $exceptionType) : Throwable {
        return ThrowableAssert::assertThrowsExceptionType($throwingCallable, $exceptionType);
    }

    /**
     * @template ThrownType of Throwable
     * @param callable $throwingCallable
     * @param class-string<ThrownType> $exceptionType
     * @param string $message
     * @return ThrownType
     */
    public static function assertThrowsExceptionTypeWithMessage(callable $throwingCallable, string $exceptionType, string $message) : Throwable {
        return ThrowableAssert::assertThrowsExceptionTypeWithMessage($throwingCallable, $exceptionType, $message);
    }
}
