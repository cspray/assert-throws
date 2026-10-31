<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use Cspray\AssertThrows\ThrowableAssert;
use Cspray\AssertThrows\ThrowableAssertTestCaseMethods;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Throwable;

#[CoversClass(ThrowableAssert::class)]
#[CoversClass(ThrowableAssertTestCaseMethods::class)]
abstract class IntegrationTestCase extends TestCase {

    public function testAssertThrowsWhenCallbackReturnsAnyException() : void {
        $expected = new RuntimeException();
        $actual = $this->invokeAssertThrows(static fn() => throw $expected);

        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWhenCallbackReturnsExpectedException() : void {
        $expected = new RuntimeException();
        $actual = $this->invokeAssertThrowsExceptionType(
            RuntimeException::class,
            static fn() => throw $expected,
        );

        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithMessageWhenCallbackReturnsExpectedException() : void {
        $expected = new RuntimeException('my message');
        $actual = $this->invokeAssertThrowsExceptionTypeWithMessageIsOrContains(
            RuntimeException::class,
            'my message',
            static fn() => throw $expected,
        );

        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithMessageMatchesRegexReturnsExpectedException() : void {
        $expected = new RuntimeException('Ellie');
        $actual = $this->invokeAssertThrowsExceptionTypeWithMessageMatchesRegex(
            RuntimeException::class,
            '/^Ellie$/',
            static fn() => throw $expected,
        );

        self::assertSame($expected, $actual);
    }

    abstract protected function invokeAssertThrows(callable $throwingCallable) : Throwable;

    /**
     * @template ThrownType of Throwable
     * @param class-string<ThrownType> $exceptionType
     * @param callable $throwingCallable
     * @return ThrownType
     */
    abstract protected function invokeAssertThrowsExceptionType(string $exceptionType, callable $throwingCallable) : Throwable;

    /**
     * @template ThrownType of Throwable
     * @param class-string<ThrownType> $exceptionType
     * @param string $message
     * @param callable $throwingCallable
     * @return ThrownType
     */
    abstract protected function invokeAssertThrowsExceptionTypeWithMessageIsOrContains(
        string $exceptionType,
        string $message,
        callable $throwingCallable,
    ) : Throwable;

    /**
     * @template ThrownType of Throwable
     * @param class-string<ThrownType> $exceptionType
     * @param string $messageRegex
     * @param callable $throwingCallable
     * @return ThrownType
     */
    abstract protected function invokeAssertThrowsExceptionTypeWithMessageMatchesRegex(
        string $exceptionType,
        string $messageRegex,
        callable $throwingCallable,
    ) : Throwable;

}
