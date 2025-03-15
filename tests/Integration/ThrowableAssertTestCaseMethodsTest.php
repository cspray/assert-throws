<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;
use Cspray\AssertThrows\ThrowableAssertTestCaseMethods;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ThrowableAssertTestCaseMethods::class)]
#[UsesClass(ThrowableAssert::class)]
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