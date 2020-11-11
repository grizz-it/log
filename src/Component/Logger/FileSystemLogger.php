<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Component\Logger;

use GrizzIt\Log\Common\LogFormatterInterface;
use PhpUnified\Log\Common\LoggerInterface;
use GrizzIt\Vfs\Common\FileSystemInterface;

class FileSystemLogger implements LoggerInterface
{
    /**
     * Contains the file system.
     *
     * @var FileSystemInterface
     */
    private $fileSystem;

    /**
     * Contains the log formatter.
     *
     * @var LogFormatterInterface
     */
    private $logFormatter;

    /**
     * Constructor.
     *
     * @param FileSystemInterface $fileSystem
     * @param LogFormatterInterface $logFormatter
     */
    public function __construct(
        FileSystemInterface $fileSystem,
        LogFormatterInterface $logFormatter
    ) {
        $this->fileSystem = $fileSystem;
        $this->logFormatter = $logFormatter;
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
        $fileName = $level . '.log';
        if (!$this->fileSystem->isFile($fileName)) {
            $this->fileSystem->touch($fileName);
        }

        $this->fileSystem->write(
            $fileName,
            $this->logFormatter->format($level, $message, $context) . PHP_EOL
        );
    }
}
