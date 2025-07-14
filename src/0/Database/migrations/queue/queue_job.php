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
        Schema::create(
            table: QueueJobModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'queue')->index();
                $table->longText(column: 'payload');
                $table->unsignedTinyInteger(column: 'attempts');
                $table->unsignedInteger(column: 'reserved_at')->nullable();
                $table->unsignedInteger(column: 'available_at');
                $table->unsignedInteger(column: 'created_at');
            });
    }


    public function down(): void
    {
        Schema::dropIfExists(table: QueueJobModel::TABLE_NAME);
    }
};
