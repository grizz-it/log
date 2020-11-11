<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Component\Formatter;

use GrizzIt\Log\Common\LogFormatterInterface;
use GrizzIt\Log\Component\Logger\TimestampTrait;
use GrizzIt\Log\Component\Logger\ExportObjectsTrait;

class PlainFormatter implements LogFormatterInterface
{
    use TimestampTrait;
    use ExportObjectsTrait;

    /**
     * Formats the log.
     *
     * @param string $level
     * @param string $message
     * @param array $context
     *
     * @return string
     */
    public function format(
        string $level,
        string $message,
        array $context = []
    ): string {
        $context = $this->formatContext($context);

        return sprintf(
            '[%s] %s %s%s',
            strtoupper($level),
            $this->getMicroTimestamp(),
            $message,
            (strlen($context) > 0 ? ' ' . $context : $context)
        );
    }

    /**
     * Formats the context to a string.
     *
     * @param array $context
     *
     * @return string
     */
    private function formatContext(array $context = []): string
    {
        if (count($context) === 0) {
            return '';
        }

        return implode(
            ' ',
            array_map(
                'trim',
                explode(
                    PHP_EOL,
                    print_r($this->exportObjects($context, true), true)
                )
            )
        );
    }
}
