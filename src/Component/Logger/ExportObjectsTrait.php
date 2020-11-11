<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Log\Component\Logger;

use DateTime;

trait ExportObjectsTrait
{
    /**
     * Converts all objects in an array to strings.
     *
     * @param mixed $context
     *
     * @return mixed
     */
    public function exportObjects($context)
    {
        if (is_array($context)) {
            foreach ($context as $key => $value) {
                $context[$key] = $this->exportObjects($value);
            }

            return $context;
        } elseif (is_object($context)) {
            if (method_exists($context, '__toString')) {
                return $context->__toString();
            }

            return get_class($context);
        }

        return $context;
    }
}
