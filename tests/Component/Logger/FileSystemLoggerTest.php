<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Tests\Component\Logger;

use PHPUnit\Framework\TestCase;
use PhpUnified\Log\Common\LoggerInterface;
use GrizzIt\Vfs\Common\FileSystemInterface;
use GrizzIt\Log\Common\LogFormatterInterface;
use GrizzIt\Log\Component\Logger\FileSystemLogger;

/**
 * @coversDefaultClass \GrizzIt\Log\Component\Logger\FileSystemLogger
 */
class FileSystemLoggerTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::log
     *
     * @return void
     */
    public function testLog(): void
    {
        $fileSystem = $this->createMock(FileSystemInterface::class);
        $logFormatter = $this->createMock(LogFormatterInterface::class);
        $subject = new FileSystemLogger($fileSystem, $logFormatter);

        $logFormatter->expects(static::once())
            ->method('format')
            ->with(LoggerInterface::INFO, 'foo', ['bar' => 'baz'])
            ->willReturn('my log');

        $fileSystem->expects(static::once())
            ->method('isFile')
            ->with('info.log')
            ->willReturn(false);

        $fileSystem->expects(static::once())
            ->method('touch')
            ->with('info.log');

        $fileSystem->expects(static::once())
            ->method('write')
            ->with('info.log', 'my log' . PHP_EOL);

        $subject->log(LoggerInterface::INFO, 'foo', ['bar' => 'baz']);
    }
}
