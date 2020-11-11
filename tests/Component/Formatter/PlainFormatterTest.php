<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Tests\Component\Formatter;

use stdClass;
use PHPUnit\Framework\TestCase;
use PhpUnified\Log\Common\LoggerInterface;
use GrizzIt\Log\Component\Formatter\PlainFormatter;

/**
 * @coversDefaultClass \GrizzIt\Log\Component\Formatter\PlainFormatter
 * @covers \GrizzIt\Log\Component\Logger\TimestampTrait
 * @covers \GrizzIt\Log\Component\Logger\ExportObjectsTrait
 */
class PlainFormatterTest extends TestCase
{
    /**
     * @covers ::format
     * @covers ::formatContext
     *
     * @return void
     */
    public function testFormat(): void
    {
        $subject = new PlainFormatter();
        $result = $subject->format(
            LoggerInterface::INFO,
            'foo',
            ['exception' => new stdClass()]
        );

        $this->assertIsString($result);
        $this->assertSame(0, strpos($result, '[INFO]'));
    }

    /**
     * @covers ::format
     * @covers ::formatContext
     *
     * @return void
     */
    public function testFormatNoContext(): void
    {
        $subject = new PlainFormatter();
        $result = $subject->format(
            LoggerInterface::INFO,
            'foo'
        );

        $this->assertIsString($result);
        $this->assertSame(0, strpos($result, '[INFO]'));
    }
}
