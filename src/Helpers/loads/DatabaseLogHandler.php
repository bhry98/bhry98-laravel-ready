<?php

namespace Bhry98\Helpers\loads;

use Bhry98\Helpers\enums\SystemActionEnums;
use Bhry98\Helpers\models\LogsSystemModel;
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
            'action' => array_key_exists('action', $record['context'] ?? []) ? $record['context']['action'] : SystemActionEnums::Other->name,
        ]);
    }
}

