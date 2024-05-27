<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use function Cspray\AssertThrows\assertThrows;
use function Cspray\AssertThrows\assertThrowsExceptionType;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessage;

class FunctionsTest extends IntegrationTestCase {

    protected function invokeAssertThrows(callable $throwingCallable) : \Throwable {
        return assertThrows($throwingCallable);
    }

    protected function invokeAssertThrowsExceptionType(callable $throwingCallable, string $exceptionType) : \Throwable {
        return assertThrowsExceptionType($throwingCallable, $exceptionType);
    }

    protected function invokeAssertThrowsExceptionTypeWithMessage(callable $throwingCallable, string $exceptionType, string $message) : \Throwable {
        return assertThrowsExceptionTypeWithMessage($throwingCallable, $exceptionType, $message);
    }
}