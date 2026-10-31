# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased Changes

## [1.0.0](https://github.com/cspray/assert-throws/tree/1.0.0) - 2026-10-31

### Added

- Add the following methods to assert a thrown Exception message matches a regex pattern:
  ```php
  ThrowableAssert::assertExceptionTypeWithMessageMatchesRegex(
        string $expectedException,
        string $expectedMessageRegex,
        callable $actual,
  );
  ThrowableAssertTestCaseMethods::assertExceptionTypeWithMessageMatchesRegex(
        string $expectedException,
        string $expectedMessageRegex,
        callable $actual,
  );
  assertExceptionTypeWithMessageMatchesRegex(
        string $expectedException,
        string $expectedMessageRegex,
        callable $actual,
  );
  ```

### Changed

- Updated to require PHP 8.3
- Updated to require PHPUnit 12.x
- Refactors the assertions made by this library to use PHPUnit's built-in
Constraints for exception expectations. This will have error messages and 
logic match the `TestCase::expectException` methods.
- Renames the `assertThrowsExceptionTypeWithMessage` methods to `assertThrowsExceptionTypeWithMessageIsOrContains` to 
more closely match the actual assertions being made. Paves the way for version supporting PHPUnit 13 to 
include `assertExceptionTypeWithMessageIs` to have an exact match on exception messages.
- Refactors the name and order of arguments to the following methods. They have been refactored to more closely match the pattern `assert(expected, actual)` used by PHPUnit.

  ```php
  ThrowableAssert::assertThrowsExceptionType(
      string $expectedException, 
      callable $actual
  );
  ThrowableAssertTestCaseMethods::assertThrowsExceptionType(
      string $expectedException, 
      callable $actual
  );
  assertThrowsExceptionType(string $expectedException, callable $actual); 
  
  ThrowableAssert::assertExceptionTypeWithMessageIsOrContains(
      string $expectedException,
      string $expectedMessage,
      callable $actual
  );
  ThrowableAssertTestCaseMethods::assertExceptionTypeWithMessageIsOrContains(
      string $expectedException,
      string $expectedMessage,
      callable $actual
  );
  assertExceptionTypeWithMessageIsOrContains(
      string $expectedException,
      string $expectedMessage,
      callable $actual
  );
  ```

## [0.2.0](https://github.com/cspray/assert-throws/tree/0.2.0) - 2025-05-15

### Changed

 - Improved the messages shown when using the assertThrows methods.

## [0.1.0](https://github.com/cspray/assert-throws/tree/0.1.0) - 2024-05-27

### Added

- Added `Cspray\AssertThrows\ThrowableAssert` class with static methods for asserting code throws an exception, optionally that the exception is of a specific type and/or with a specific message.
- Added global functions and a trait for using in `PHPUnit\Framework\TestCase` implementations. These allow for a variety of different uses based on the preference of the code integrating cspray/assert-throws.

