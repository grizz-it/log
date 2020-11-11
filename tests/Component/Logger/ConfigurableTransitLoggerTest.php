<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Tests\Component\Logger;

use PHPUnit\Framework\TestCase;
use PhpUnified\Log\Common\LoggerInterface;
use GrizzIt\Log\Component\Logger\ConfigurableTransitLogger;

/**
 * @coversDefaultClass \GrizzIt\Log\Component\Logger\ConfigurableTransitLogger
 */
class ConfigurableTransitLoggerTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::log
     *
     * @return void
     */
    public function testLogNoEmergency(): void
    {
        $subject = new ConfigurableTransitLogger(false);
        $logger = $this->createMock(LoggerInterface::class);
        $subject->addLogger($logger);

        $logger->expects(static::once())
            ->method('log')
            ->with(LoggerInterface::FATAL, 'foo', ['bar' => 'baz']);

        $subject->log(LoggerInterface::EMERGENCY, 'qux', ['foo' => 'bar']);
        $subject->log(LoggerInterface::FATAL, 'foo', ['bar' => 'baz']);
    }

    /**
     * @covers ::__construct
     * @covers ::log
     *
     * @return void
     */
    public function testLogNoFatal(): void
    {
        $subject = new ConfigurableTransitLogger(true, false);
        $logger = $this->createMock(LoggerInterface::class);
        $subject->addLogger($logger);

        $logger->expects(static::once())
            ->method('log')
            ->with(LoggerInterface::EMERGENCY, 'foo', ['bar' => 'baz']);

        $subject->log(LoggerInterface::FATAL, 'qux', ['foo' => 'bar']);
        $subject->log(LoggerInterface::EMERGENCY, 'foo', ['bar' => 'baz']);
    }
}
