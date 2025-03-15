<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\UsesClass;
use Throwable;
use function Cspray\AssertThrows\assertThrows;
use function Cspray\AssertThrows\assertThrowsExceptionType;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessage;

#[CoversFunction('Cspray\AssertThrows\assertThrows')]
#[CoversFunction('Cspray\AssertThrows\assertThrowsExceptionType')]
#[CoversFunction('Cspray\AssertThrows\assertThrowsExceptionTypeWithMessage')]
#[UsesClass(ThrowableAssert::class)]
class FunctionsTest extends IntegrationTestCase {

    protected function invokeAssertThrows(callable $throwingCallable) : Throwable {
        return assertThrows($throwingCallable);
    }

    protected function invokeAssertThrowsExceptionType(callable $throwingCallable, string $exceptionType) : Throwable {
        return assertThrowsExceptionType($throwingCallable, $exceptionType);
    }

    protected function invokeAssertThrowsExceptionTypeWithMessage(callable $throwingCallable, string $exceptionType, string $message) : Throwable {
        return assertThrowsExceptionTypeWithMessage($throwingCallable, $exceptionType, $message);
    }
}