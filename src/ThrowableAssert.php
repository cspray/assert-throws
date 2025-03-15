<?php declare(strict_types=1);

namespace Cspray\AssertThrows;

use PHPUnit\Framework\Assert;
use Throwable;

final class ThrowableAssert {

    /** @codeCoverageIgnore  */
    private function __construct() {}

    public static function assertThrows(callable $throwingCallable) : Throwable {
        $exception = null;
        try {
            $throwingCallable();
        } catch (Throwable $throwable) {
            $exception = $throwable;
        } finally {
            Assert::assertNotNull(
                $exception,
                'Expected callable to throw an exception, but none was thrown.'
            );

            return $exception;
        }
    }

    /**
     * @template ThrownType of Throwable
     * @param callable $throwingCallable
     * @param class-string<ThrownType> $exceptionType
     * @return ThrownType
     */
    public static function assertThrowsExceptionType(
        callable $throwingCallable,
        string $exceptionType
    ) : Throwable {
        $exception = null;
        try {
           $throwingCallable();
        } catch (Throwable $throwable) {
            $exception = $throwable;
        } finally {
            Assert::assertNotNull(
                $exception,
                sprintf('Expected callable to throw an exception of type "%s", but none was thrown.', $exceptionType),
            );
            Assert::assertInstanceOf(
                $exceptionType,
                $exception,
                sprintf(
                    'Expected callable to throw an exception of type "%s", but "%s" was thrown. Message: %s',
                    $exceptionType,
                    $exception::class,
                    $exception->getMessage()
                )
            );

            return $exception;
        }

    }

    /**
     * @template ThrownType of Throwable
     * @param callable $throwingCallable
     * @param class-string<ThrownType> $exceptionType
     * @param string $message
     * @return ThrownType
     */
    public static function assertThrowsExceptionTypeWithMessage(
        callable $throwingCallable,
        string $exceptionType,
        string $message
    ) : Throwable {
        $throwable = self::assertThrowsExceptionType($throwingCallable, $exceptionType);
        Assert::assertSame(
            $message,
            $throwable->getMessage(),
            sprintf(
                'Expected exception thrown from callable to have message "%s", but it has "%s".',
                $message,
                $throwable->getMessage()
            )
        );

        return $throwable;
    }

}
