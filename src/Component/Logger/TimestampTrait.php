<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Component\Logger;

use DateTime;

trait TimestampTrait
{
    /**
     * Retrieves the current timestamp with microtime.
     *
     * @return string
     */
    public function getMicroTimestamp(): string
    {
        return DateTime::createFromFormat(
            'U.u',
            microtime(true)
        )->format("Y-m-d H:i:s.u");
    }
}
