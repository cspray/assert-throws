<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;

class ThrowableAssertTest extends IntegrationTestCase {

    protected function invokeAssertThrows(callable $throwingCallable) : \Throwable {
        return ThrowableAssert::assertThrows($throwingCallable);
    }

    protected function invokeAssertThrowsExceptionType(callable $throwingCallable, string $exceptionType) : \Throwable {
        return ThrowableAssert::assertThrowsExceptionType($throwingCallable, $exceptionType);
    }

    protected function invokeAssertThrowsExceptionTypeWithMessage(callable $throwingCallable, string $exceptionType, string $message) : \Throwable {
        return ThrowableAssert::assertThrowsExceptionTypeWithMessage($throwingCallable, $exceptionType, $message);
    }
}