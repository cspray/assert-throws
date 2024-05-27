<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Integration;

use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase {

    public function testAssertThrows() : void {
        $expected = new \RuntimeException();
        $actual = $this->invokeAssertThrows(static fn() => throw $expected);

        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionType() : void {
        $expected = new \RuntimeException();
        $actual = $this->invokeAssertThrowsExceptionType(static fn() => throw $expected, \RuntimeException::class);

        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithMessage() : void {
        $expected = new \RuntimeException('my message');
        $actual = $this->invokeAssertThrowsExceptionTypeWithMessage(static fn() => throw $expected, \RuntimeException::class, 'my message');

        self::assertSame($expected, $actual);
    }


    abstract protected function invokeAssertThrows(callable $throwingCallable) : \Throwable;

    /**
     * @template ThrownType of Throwable
     * @param callable $throwingCallable
     * @param class-string<ThrownType> $exceptionType
     * @return ThrownType
     */
    abstract protected function invokeAssertThrowsExceptionType(callable $throwingCallable, string $exceptionType) : \Throwable;

    /**
     * @template ThrownType of Throwable
     * @param callable $throwingCallable
     * @param class-string<ThrownType> $exceptionType
     * @param string $message
     * @return ThrownType
     */
    abstract protected function invokeAssertThrowsExceptionTypeWithMessage(
        callable $throwingCallable,
        string $exceptionType,
        string $message
    ) : \Throwable;

}
