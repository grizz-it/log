[![Build Status](https://travis-ci.com/grizz-it/log.svg?branch=master)](https://travis-ci.com/grizz-it/log)

# GrizzIT Log

This package contains an implementation of the `php-unified/log` standard using
the `grizz-it/vfs` package. The logger create single line entries in a file
based on the log level.

## Installation

To install the package run the following command:

```
composer require grizz-it/log
```

## Usage

### Formatters

The formatters are used to format logs. This package makes two formatters
available. The formatters are described by the
[LogFormatterInterface](src/Common/LogFormatterInterface.php)

#### [JsonFormatter](src/Component/Formatter/JsonFormatter.php)

The JSON formatter makes a JSON string of the log information, so it can be
picked up by external systems.

```json
{"level":"info","message":"foo","timestamp":"2020-11-11 21:56:46.201300","exception":"Exception in...
```

#### [PlainFormatter](src/Component/Formatter/PlainFormatter.php)

The plain formatter makes a simple, readable string as a log entry.

```
[INFO] 2020-11-11 21:54:58.750400 foo Array ( [exception] => Exception in /...
```

### Loggers

The package provides two loggers.

#### [ConfigurableTransitLogger](src/Component/Logger/ConfigurableTransitLogger.php)

This is a transit logger that can be used to prevent certain log levels from
being emitted. The log levels can be disabled through the constructor
parameters. After that, additional loggers (that perform the actual logging)
can be added by providing them to the `addLogger` method.

#### [FileSystemLogger](src/Component/Logger/FileSystemLogger.php)

The file system logger is a logger that uses `grizz-it/vfs` to store the logs.
The file is determined based on the log level. So all `info` logs are being
stored in the `info.log` file, all `emergency` logs are stored in
`emergency.log`, etc..

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## MIT License

Copyright (c) GrizzIT

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.