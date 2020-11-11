<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Component\Logger;

use PhpUnified\Log\TransitLogger;
use PhpUnified\Log\Common\LoggerInterface;
use GrizzIt\Vfs\Common\FileSystemInterface;
use GrizzIt\Log\Common\LogFormatterInterface;
use PhpUnified\Log\Common\TransitLoggerInterface;

class ConfigurableTransitLogger extends TransitLogger
{
    /**
     * Contains the allowed log levels.
     *
     * @var array
     */
    private $allowedLogs = [];

    /**
     * Constructor.
     *
     * @param bool $allowEmergency
     * @param bool $allowFatal
     * @param bool $allowError
     * @param bool $allowWarning
     * @param bool $allowNotice
     * @param bool $allowInfo
     * @param bool $allowDebug
     */
    public function __construct(
        bool $allowEmergency = true,
        bool $allowFatal = true,
        bool $allowError = true,
        bool $allowWarning = true,
        bool $allowNotice = true,
        bool $allowInfo = true,
        bool $allowDebug = true
    ) {
        if ($allowEmergency) {
            $this->allowedLogs[] = LoggerInterface::EMERGENCY;
        }

        if ($allowFatal) {
            $this->allowedLogs[] = LoggerInterface::FATAL;
        }

        if ($allowError) {
            $this->allowedLogs[] = LoggerInterface::ERROR;
        }

        if ($allowWarning) {
            $this->allowedLogs[] = LoggerInterface::WARNING;
        }

        if ($allowNotice) {
            $this->allowedLogs[] = LoggerInterface::NOTICE;
        }

        if ($allowInfo) {
            $this->allowedLogs[] = LoggerInterface::INFO;
        }

        if ($allowDebug) {
            $this->allowedLogs[] = LoggerInterface::DEBUG;
        }
    }

    /**
     * Logs a message by a defined severity.
     *
     * @param string $level   The severity of the log.
     * @param string $message The message that needs to be logged.
     * @param array  $context Additional context for the log.
     *
     * @return void
     */
    public function log(
        string $level,
        string $message,
        array $context = []
    ): void {
        if (in_array($level, $this->allowedLogs)) {
            parent::log($level, $message, $context);
        }
    }
}
