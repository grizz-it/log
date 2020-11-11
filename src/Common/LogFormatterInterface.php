<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Common;

interface LogFormatterInterface
{
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
    ): string;
}
