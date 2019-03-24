<?php

namespace PhilKra\Exception\Generator;

/**
 * Schema file not found
 */
class SchemaFileNotFoundException extends \Exception
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('The schema file "%s" could not be found', $message), $code, $previous);
    }
}
