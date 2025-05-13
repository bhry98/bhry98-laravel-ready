<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\queue\{
    QueueJobBatchesModel,
    QueueJobModel,
    QueueJobFailedModel,
};

return new class extends Migration {

    public function up(): void
    {
        Schema::create(table: QueueJobBatchesModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->string(column: 'id')->primary();
                $table->string(column: 'name');
                $table->integer(column: 'total_jobs');
                $table->integer(column: 'pending_jobs');
                $table->integer(column: 'failed_jobs');
                $table->longText(column: 'failed_job_ids');
                $table->mediumText(column: 'options')->nullable();
                $table->integer(column: 'cancelled_at')->nullable();
                $table->integer(column: 'created_at');
                $table->integer(column: 'finished_at')->nullable();
            });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: QueueJobBatchesModel::TABLE_NAME);
    }
};
