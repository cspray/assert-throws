# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased Changes

## [0.1.0](https://github.com/cspray/assert-throws/tree/0.1.0) - 2024-05-27

### Added

- Added `Cspray\AssertThrows\ThrowableAssert` class with static methods for asserting code throws an exception, optionally that the exception is of a specific type and/or with a specific message.
- Added global functions and a trait for using in `PHPUnit\Framework\TestCase` implementations. These allow for a variety of different uses based on the preference of the code integrating cspray/assert-throws.

