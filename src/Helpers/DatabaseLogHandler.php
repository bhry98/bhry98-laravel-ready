<?php

namespace Bhry98\Bhry98LaravelReady\Helpers;

use Bhry98\Bhry98LaravelReady\Models\logs\LogsSystemModel;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class DatabaseLogHandler extends AbstractProcessingHandler
{

    /**
     * Write the log entry to the database.
     *
     * @param array|LogRecord $record
     * @return void
     */
    protected function write(array|\Monolog\LogRecord $record): void
    {
        LogsSystemModel::query()->create([
            'log_level' => $record['level_name'],
            'message' => $record['message'],
            'context' => $record['context'],
        ]);
    }
}

