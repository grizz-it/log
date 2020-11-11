<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Tests\Component\Formatter;

use Exception;
use PHPUnit\Framework\TestCase;
use PhpUnified\Log\Common\LoggerInterface;
use GrizzIt\Log\Component\Formatter\JsonFormatter;

/**
 * @coversDefaultClass \GrizzIt\Log\Component\Formatter\JsonFormatter
 * @covers \GrizzIt\Log\Component\Logger\TimestampTrait
 * @covers \GrizzIt\Log\Component\Logger\ExportObjectsTrait
 */
class JsonFormatterTest extends TestCase
{
    /**
     * @covers ::format
     *
     * @return void
     */
    public function testFormat(): void
    {
        $subject = new JsonFormatter();
        $result = $subject->format(
            LoggerInterface::INFO,
            'foo',
            [
                'exception' => new Exception(),
                'bar' => 'baz'
            ]
        );

        $decoded = json_decode($result, true);
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());
        $this->assertEquals(LoggerInterface::INFO, $decoded['level']);
        $this->assertEquals('foo', $decoded['message']);
        $this->assertEquals(
            ['level', 'message', 'timestamp', 'exception', 'bar'],
            array_keys($decoded)
        );
    }
}
