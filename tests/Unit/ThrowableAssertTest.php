<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Unit;

use Cspray\AssertThrows\ThrowableAssert;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use BadMethodCallException;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(ThrowableAssert::class)]
final class ThrowableAssertTest extends TestCase {
    public function testAssertThrowsCallableDoesNotThrowFailsTestAndDoesNotAddToAssertionCount() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Expected callable to throw an exception but none was thrown.');

        ThrowableAssert::assertThrows(static function() {});
    }

    public function testAssertThrowsCallableDoesThrowDoesNotFailTestAddsToAssertionCountAndReturnsThrowable() : void {
        Assert::resetCount();

        $expected = new RuntimeException();
        $actual = ThrowableAssert::assertThrows(static fn() => throw $expected);

        self::assertSame(1, Assert::getCount());
        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithNoExceptionThrownHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Expected callable to throw an exception of type "RuntimeException" but none was thrown.');

        ThrowableAssert::assertThrowsExceptionType(
            static function() {},
            RuntimeException::class
        );
    }

    public function testAssertThrowsExceptionTypeWithWrongExceptionTypeThrownHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Expected callable to throw an exception of type "RuntimeException" but "BadMethodCallException" was thrown.');

        ThrowableAssert::assertThrowsExceptionType(
            static fn () => throw new BadMethodCallException(),
            RuntimeException::class
        );
    }

    public function testAssertThrowsExceptionTypeWithCorrectExceptionTypeHasAppropriateAssertCountAndReturnsException() : void {
        Assert::resetCount();

        $expected = new RuntimeException();
        $actual = ThrowableAssert::assertThrowsExceptionType(
            static fn() => throw $expected,
            RuntimeException::class
        );

        self::assertSame(2, Assert::getCount());
        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithMessageWithNoExceptionCallableDoesNotThrowHasAssertionFailedError() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Expected callable to throw an exception of type "RuntimeException" but none was thrown.');

        ThrowableAssert::assertThrowsExceptionTypeWithMessage(
            static function () {},
            RuntimeException::class,
            'My exception message.'
        );
    }

    public function testAssertThrowsExceptionTypeWithMessageWrongExceptionTypeThrownHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Expected callable to throw an exception of type "RuntimeException" but "BadMethodCallException" was thrown.');

        ThrowableAssert::assertThrowsExceptionTypeWithMessage(
            static fn () => throw new BadMethodCallException(),
            RuntimeException::class,
            'My exception message.'
        );
    }

    public function testAssertThrowsExceptionTypeWithMessageIncorrectMessageInThrownExceptionHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Expected exception thrown from callable to have message "not anything" but it has "anything".');

        ThrowableAssert::assertThrowsExceptionTypeWithMessage(
            static fn () => throw new RuntimeException('anything'),
            RuntimeException::class,
            'not anything'
        );
    }

    public function testAssertThrowsExceptionTypeWithMessageCorrectExceptionTypeHasAppropriateAssertCountAndReturnsException() : void {
        Assert::resetCount();

        $expected = new RuntimeException('My runtime message');
        $actual = ThrowableAssert::assertThrowsExceptionTypeWithMessage(
            static fn() => throw $expected,
            RuntimeException::class,
            'My runtime message'
        );

        self::assertSame(3, Assert::getCount());
        self::assertSame($expected, $actual);
    }
}
