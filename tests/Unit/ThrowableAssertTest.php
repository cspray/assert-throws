<?php declare(strict_types=1);

namespace Cspray\AssertThrows\Test\Unit;

use Cspray\AssertThrows\ThrowableAssert;
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
        $this->expectExceptionMessage(
            'Failed asserting that exception of type "Throwable" is thrown.',
        );

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
        $this->expectExceptionMessage(
            'Failed asserting that exception of type "RuntimeException" is thrown.',
        );


        ThrowableAssert::assertThrowsExceptionType(
            RuntimeException::class,
            static function() {},
        );
    }

    public function testAssertThrowsExceptionTypeWithWrongExceptionTypeThrownHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(
            'Failed asserting that exception of type "BadMethodCallException" matches expected exception "RuntimeException". Message was: ""'
        );

        ThrowableAssert::assertThrowsExceptionType(
            RuntimeException::class,
            static fn () => throw new BadMethodCallException(),
        );
    }

    public function testAssertThrowsExceptionTypeWithCorrectExceptionTypeHasAppropriateAssertCountAndReturnsException() : void {
        Assert::resetCount();

        $expected = new RuntimeException();
        $actual = ThrowableAssert::assertThrowsExceptionType(
            RuntimeException::class,
            static fn() => throw $expected,
        );

        self::assertSame(1, Assert::getCount());
        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithMessageWithNoExceptionCallableDoesNotThrowHasAssertionFailedError() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(
            'Failed asserting that exception of type "RuntimeException" is thrown.'
        );

        ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains(
            RuntimeException::class,
            'My exception message.',
            static function () {},
        );
    }

    public function testAssertThrowsExceptionTypeWithMessageWrongExceptionTypeThrownHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(
            'Failed asserting that exception of type "BadMethodCallException" matches expected exception "RuntimeException". Message was: "badmethod message"'
        );

        ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains(
            RuntimeException::class,
            'My exception message.',
            static fn () => throw new BadMethodCallException('badmethod message'),
        );
    }

    public function testAssertThrowsExceptionTypeWithMessageIncorrectMessageInThrownExceptionHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(
            'Failed asserting that exception message \'anything\' contains \'not anything\'.'
        );

        ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains(
            RuntimeException::class,
            'not anything',
            static fn () => throw new RuntimeException('anything'),
        );
    }

    public function testAssertThrowsExceptionTypeWithMessageCorrectExceptionTypeHasAppropriateAssertCountAndReturnsException() : void {
        Assert::resetCount();

        $expected = new RuntimeException('My runtime message');
        $actual = ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains(
            RuntimeException::class,
            'My runtime message',
            static fn() => throw $expected,
        );

        self::assertSame(2, Assert::getCount());
        self::assertSame($expected, $actual);
    }

    public function testAssertThrowsExceptionTypeWithMessageNotMatchingRegexHasCorrectAssertionFailure() : void {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(
            'Failed asserting that exception message \'Ellie\' matches \'/^Mack$/\'.'
        );

        ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex(
            RuntimeException::class,
            '/^Mack$/',
            static fn() => throw new RuntimeException('Ellie'),
        );
    }

    public function testAssertThrowsExceptionWithMessageMatchesHasAppropriateAssertCountAndReturnsException() : void {
        Assert::resetCount();

        $expected = new RuntimeException('Mack');
        $actual = ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex(
            RuntimeException::class,
            '/^Mack$/',
            static fn() => throw $expected,
        );

        self::assertSame(2, Assert::getCount());
        self::assertSame($expected, $actual);
    }
}
