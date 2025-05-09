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
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            table: QueueJobFailedModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: QueueJobFailedModel::TABLE_NAME);
    }
};
