<?php

use Bhry98\Helpers\models\QueueJobFailedModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create((new QueueJobFailedModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
    }


    public function down(): void
    {
        Schema::dropIfExists((new QueueJobFailedModel)->getTable());
    }
};
