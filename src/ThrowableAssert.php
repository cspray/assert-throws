<?php declare(strict_types=1);

namespace Cspray\AssertThrows;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionMessageIsOrContains;
use PHPUnit\Framework\Constraint\ExceptionMessageMatchesRegularExpression;
use Throwable;

final class ThrowableAssert {

    /** @codeCoverageIgnore  */
    /** @psalm-suppress UnusedConstructor */
    private function __construct() {}

    /**
     * Assert that any exception is thrown by the $throwingCallable.
     *
     * @param callable $actual
     * @return Throwable
     */
    public static function assertThrows(callable $actual) : Throwable {
        return self::assertThrowsExceptionType(Throwable::class, $actual);
    }

    /**
     * Assert that an exception of a specific type is thrown by the $throwingCallable.
     *
     * @template ThrownType of Throwable
     * @param class-string<ThrownType> $expectedException
     * @param callable $actual
     * @return ThrownType
     */
    public static function assertThrowsExceptionType(string $expectedException, callable $actual) : Throwable {
        $exception = null;
        try {
           $actual();
        } catch (Throwable $throwable) {
            $exception = $throwable;
        } finally {
            Assert::assertThat(
                $exception,
                new ExceptionConstraint($expectedException),
            );

            assert($exception instanceof $expectedException);
            return $exception;
        }

    }

    /**
     * Assert that $throwingCallable throws an exception that is an instance of $exceptionType and has a message that
     * is or contains the $message.
     *
     * @template ThrownType of Throwable
     * @param class-string<ThrownType> $expectedException
     * @param string $expectedMessage
     * @param callable $actual
     * @return ThrownType
     */
    public static function assertThrowsExceptionTypeWithMessageIsOrContains(
        string $expectedException,
        string $expectedMessage,
        callable $actual,
    ) : Throwable {
        $throwable = self::assertThrowsExceptionType($expectedException, $actual);
        Assert::assertThat(
            $throwable->getMessage(),
            new ExceptionMessageIsOrContains($expectedMessage),
        );

        return $throwable;
    }

    /**
     * Assert that $throwingCallable throws an exception that is an instance of $exceptionType and has a message that
     * matches the regex $messageRegex.
     *
     * @template ThrownType of Throwable
     * @param class-string<ThrownType> $expectedException
     * @param non-empty-string $expectedMessageRegex
     * @param callable $actual
     * @return ThrownType
     */
    public static function assertThrowsExceptionTypeWithMessageMatchesRegex(
        string $expectedException,
        string $expectedMessageRegex,
        callable $actual,
    ) : Throwable {
        $throwable = self::assertThrowsExceptionType($expectedException, $actual);
        Assert::assertThat(
            $throwable->getMessage(),
            new ExceptionMessageMatchesRegularExpression($expectedMessageRegex),
        );

        return $throwable;
    }

}
