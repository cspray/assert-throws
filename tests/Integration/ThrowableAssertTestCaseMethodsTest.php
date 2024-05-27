<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssertTestCaseMethods;

class ThrowableAssertTestCaseMethodsTest extends IntegrationTestCase {

    use ThrowableAssertTestCaseMethods;

    protected function invokeAssertThrows(callable $throwingCallable) : \Throwable {
        return self::assertThrows($throwingCallable);
    }

    protected function invokeAssertThrowsExceptionType(callable $throwingCallable, string $exceptionType) : \Throwable {
        return self::assertThrowsExceptionType($throwingCallable, $exceptionType);
    }

    protected function invokeAssertThrowsExceptionTypeWithMessage(callable $throwingCallable, string $exceptionType, string $message) : \Throwable {
        return self::assertThrowsExceptionTypeWithMessage($throwingCallable, $exceptionType, $message);
    }
}