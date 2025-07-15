<?php

namespace Bhry98\Helpers\loads;

use Monolog\Logger;

class LoggerHandler
{
    /**
     * Create a custom Monolog instance.
     *
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        // Create a new Monolog instance
        $logger = new Logger('database');

        // Add the custom database handler
        $logger->pushHandler(new DatabaseLogHandler());

        return $logger;
    }
}
