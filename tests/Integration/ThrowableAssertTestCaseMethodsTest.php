<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;
use Cspray\AssertThrows\ThrowableAssertTestCaseMethods;
use Override;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\UsesClass;
use Throwable;

#[CoversTrait(ThrowableAssertTestCaseMethods::class)]
#[UsesClass(ThrowableAssert::class)]
class ThrowableAssertTestCaseMethodsTest extends IntegrationTestCase {

    use ThrowableAssertTestCaseMethods;

    #[Override]
    protected function invokeAssertThrows(callable $throwingCallable) : \Throwable {
        return self::assertThrows($throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionType(string $exceptionType, callable $throwingCallable) : \Throwable {
        return self::assertThrowsExceptionType($exceptionType, $throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionTypeWithMessageIsOrContains(
        string $exceptionType,
        string $message,
        callable $throwingCallable,
    ) : \Throwable {
        return self::assertThrowsExceptionTypeWithMessageIsOrContains($exceptionType, $message, $throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionTypeWithMessageMatchesRegex(
        string $exceptionType,
        string $messageRegex,
        callable $throwingCallable,
    ) : Throwable {
        return self::assertThrowsExceptionTypeWithMessageMatchesRegex($exceptionType, $messageRegex, $throwingCallable);
    }
}