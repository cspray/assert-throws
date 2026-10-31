<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;
use Override;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\UsesClass;
use Throwable;
use function Cspray\AssertThrows\assertThrows;
use function Cspray\AssertThrows\assertThrowsExceptionType;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessageIsOrContains;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessageMatchesRegex;

#[CoversFunction('Cspray\AssertThrows\assertThrows')]
#[CoversFunction('Cspray\AssertThrows\assertThrowsExceptionType')]
#[CoversFunction('Cspray\AssertThrows\assertThrowsExceptionTypeWithMessageIsOrContains')]
#[CoversFunction('Cspray\AssertThrows\assertThrowsExceptionTypeWithMessageMatchesRegex')]
#[UsesClass(ThrowableAssert::class)]
class FunctionsTest extends IntegrationTestCase {

    #[Override]
    protected function invokeAssertThrows(callable $throwingCallable) : Throwable {
        return assertThrows($throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionType(string $exceptionType, callable $throwingCallable) : Throwable {
        return assertThrowsExceptionType($exceptionType, $throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionTypeWithMessageIsOrContains(
        string $exceptionType,
        string $message,
        callable $throwingCallable,
    ) : Throwable {
        return assertThrowsExceptionTypeWithMessageIsOrContains($exceptionType, $message, $throwingCallable);
    }

    #[Override]
    protected function invokeAssertThrowsExceptionTypeWithMessageMatchesRegex(
        string $exceptionType,
        string $messageRegex,
        callable $throwingCallable,
    ) : Throwable {
        return assertThrowsExceptionTypeWithMessageMatchesRegex($exceptionType, $messageRegex, $throwingCallable);
    }
}