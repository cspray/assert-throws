# cspray/assert-throws

Provides an alternative way to test code that throws exceptions using PHPUnit 10 or 11. The primary benefit being access 
to the thrown Exception for further inspection. This might prove useful when you need to check for details of an 
exception that aren't available to be expected in PHPUnit. The below example acts as a Quick Start, for more details 
check out the [Detailed Guide](#Detailed-Guide) below.

```php
<?php declare(strict_types=1);

use Cspray\AssertThrows\ThrowableAssert;
use PHPUnit\Framework\TestCase;

final class MyTest extends TestCase {
    public function testExceptionPreviousInstanceOf() : void {
        $throwable = ThrowableAssert::assertThrows(
            static fn() => throw new RuntimeException(previous: new BadMethodCallException())
        );
        
        self::assertInstanceOf(BadMethodCallException::class, $throwable->getPrevious());
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
    static fn() => throw new BadMethodCallException(),
    BadMethodCallException::class
);

$throwable = ThrowableAssert::assertThrowsExceptionTypeWithMessage(
    static fn() => throw new RuntimeException('My exception message'),
    RuntimeException::class,
    'My exception message'
);
```

In addition to the `ThrowableAssert` class with static methods there are global functions available:

```php
<?php

use function Cspray\AssertThrows\assertThrows;
use function Cspray\AssertThrows\assertThrowsExceptionType;
use function Cspray\AssertThrows\assertThrowsExceptionTypeWithMessage;

$throwable = assertThrows(static fn() => throw new RuntimeException());

$throwable = assertThrowsExceptionType(
    static fn() => throw new BadMethodCallException(),
    BadMethodCallException::class
);

$throwable = assertThrowsExceptionTypeWithMessage(
    static fn() => throw new RuntimeException('My exception message'),
    RuntimeException::class,
    'My exception message'
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
            static fn() => throw new BadMethodCallException(),
            BadMethodCallException::class
        );
    }
    
    public function testAssertThrowsExceptionTypeWithMessage() : void {
        $throwable = self::assertThrowsExceptionTypeWithMessage(
            static fn() => throw new RuntimeException('My exception message'),
            RuntimeException::class,
            'My exception message'
        );
    }
}
```

Which method you use is a personal preference. Ultimately, all examples utilize the static methods available in the 
`ThrowableAssert` class.