# AssertThrows

Allows testing thrown Exceptions that contain contextual information, using [PHPUnit](https://phpunit.de). PHPUnit comes 
out-of-the-box with several methods for testing code that throws an exception. While these work for most typical cases, 
there are scenarios where we need to test something about the thrown Exception that is not available with PHPUnit. This
library allows your code to still expect an Exception is thrown, but provides access to the thrown Exception so that
further assertions can be made on the data within.

**This library is not intended to replace `\PHPUnit\Framework\TestCase::expectException` and similar methods!** If you 
aren't testing something on the Exception outside the message or code you should be using PHPUnit's built-in methods.

## Quick Start

```php
<?php declare(strict_types=1);

use Cspray\AssertThrows\ThrowableAssert;
use PHPUnit\Framework\TestCase;

final class MyTest extends TestCase {
    public function testExceptionPreviousInstanceOf() : void {
        $throwable = ThrowableAssert::assertThrows(
            static fn() => throw new RuntimeException(
                previous: new BadMethodCallException(),
            ),
        );
        
        self::assertInstanceOf(
            BadMethodCallException::class,
            $throwable->getPrevious(),
        );
    }
}
```

## Installation

[Composer](https://getcomposer.org/) is the only supported method to install this package.

```shell
composer require --dev cspray/assert-throws
```

## Detailed Guide

PHPUnit provides a reasonable way to test for expected exceptions out-of-the-box. For most situations, the PHPUnit provided
methods should be sufficient. However, there are scenarios where you might need to test exception throwing code in a way 
not readily available in PHPUnit. Examples of this include code where you want to test the _previous_ exception or if the
exception includes domain specific information. It is in these situations that this library is most appropriate.

All the assertions provided by this library takes a callable that is expected to throw an exception. If an exception 
is not thrown a `PHPUnit\Framework\ExpectationFailedException` will be thrown resulting in a test failure. Otherwise, the 
thrown exception will be returned for additional assertions.

The following static methods are available on the `Cspray\AssertThrows\ThrowableAssert` class:

```php
<?php

use \Cspray\AssertThrows\ThrowableAssert;

$throwable = ThrowableAssert::assertThrows(static fn() => throw new RuntimeException());

$throwable = ThrowableAssert::assertThrowsExceptionType(
    BadMethodCallException::class,
    static fn() => throw new BadMethodCallException(),
);

$throwable = ThrowableAssert::assertThrowsExceptionTypeWithMessageIsOrContains(
    RuntimeException::class,
    'My exception message',
    static fn() => throw new RuntimeException('My exception message'),
);

$throwable = ThrowableAssert::assertThrowsExceptionTypeWithMessageMatchesRegex(
    RuntimeException::class,
    '/^Error message$/',
    static fn() => throw new RuntimeException('Error message'),
);
```

In addition to the `ThrowableAssert` class with static methods there are global functions available:

```php
<?php

use function Cspray\AssertThrows\assertThrows;
use function Cspray\AssertThrows\assertThrowsExceptionType;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessageIsOrContains;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessageMatchesRegex;

$throwable = assertThrows(static fn() => throw new RuntimeException());

$throwable = assertThrowsExceptionType(
    BadMethodCallException::class,
    static fn() => throw new BadMethodCallException(),
);

$throwable = assertThrowsExceptionTypeWithMessageIsOrContains(
    RuntimeException::class,
    'My exception message',
    static fn() => throw new RuntimeException('My exception message'),
);

$throwable = assertThrowsExceptionTypeWithMessageMatchesRegex(
    RuntimeException::class,
    '/^Error message$/',
    static fn() => throw new RuntimeException('Error message'),
);
```

As well as a trait to use in your `PHPUnit\Framework\TestCase` implementations:

```php
<?php

use Cspray\AssertThrows\ThrowableAssertTestCaseMethods;
use PHPUnit\Framework\TestCase;

class MyTestCase extends TestCase {
    use ThrowableAssertTestCaseMethods;
    
    public function testAssertThrows() : void {
        $throwable = self::assertThrows(static fn() => new RuntimeException());
    }
    
    public function testAssertThrowsExceptionType() : void {
        $throwable = self::assertThrowsExceptionType(
            BadMethodCallException::class,
            static fn() => throw new BadMethodCallException(),
        );
    }
    
    public function testAssertThrowsExceptionTypeWithMessageIsOrContains() : void {
        $throwable = self::assertThrowsExceptionTypeWithMessageIsOrContains(
            RuntimeException::class,
            'My exception message',
            static fn() => throw new RuntimeException('My exception message'),
        );
    }
    
    public function testAssertThrowsExceptionTypeWithMessageMatchesRegex() : void {
        $throwable = assertThrowsExceptionTypeWithMessageMatchesRegex(
            RuntimeException::class,
            '/^Error message$/',
            static fn() => throw new RuntimeException('Error message'),
        );
    }
}
```

Which method you use is a personal preference. Ultimately, all examples utilize the static methods available in the 
`ThrowableAssert` class.

## PHPUnit Version Map

This library aims to support stable versions of PHPUnit. For current releases, that includes PHPUnit 12 and 13. Earlier 
versions of this library supported PHPUnit 10 and 11; 

| PHPUnit Version | Assert Throws Version | Support Status |
| --------------- | --------------------- | -------------- |
 | 13 | 2.x | Stable Support |
| 12 | 1.x | Stable Support |
| 11 | 0.2.0 | End of Life |
| 10 | 0.2.0 | End of Life |