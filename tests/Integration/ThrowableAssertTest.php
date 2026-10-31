<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use Throwable;

#[CoversClass(ThrowableAssert::class)]
class ThrowableAssertTest extends IntegrationTestCase {

    #[Override]
    protected function invokeAssertThrows(callable $throwingCallable) : Throwable {
        return ThrowableAssert::assertThrows($throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionType(string $exceptionType, callable $throwingCallable) : Throwable {
        return ThrowableAssert::assertThrowsExceptionType($exceptionType, $throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionTypeWithMessageIsOrContains(
        string $exceptionType,
        string $message,
        callable $throwingCallable,
    ) : Throwable {
        return ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains($exceptionType, $message, $throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionTypeWithMessageMatchesRegex(
        string $exceptionType,
        string $messageRegex,
        callable $throwingCallable,
    ) : Throwable {
        return ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex($exceptionType, $messageRegex, $throwingCallable);
    }
}