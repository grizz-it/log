<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Component\Formatter;

use Throwable;
use GrizzIt\Log\Common\LogFormatterInterface;
use GrizzIt\Log\Component\Logger\TimestampTrait;
use GrizzIt\Log\Component\Logger\ExportObjectsTrait;

class JsonFormatter implements LogFormatterInterface
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
        return json_encode(
            array_merge(
                [
                    'level' => $level,
                    'message' => $message,
                    'timestamp' => $this->getMicroTimestamp()
                ],
                $this->exportObjects($context)
            )
        );
    }
}
