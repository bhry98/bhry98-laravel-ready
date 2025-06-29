<?php

namespace Bhry98\Bhry98LaravelReady\Helpers\logs;

use Monolog\Logger;

class CreateCustomLogger
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
