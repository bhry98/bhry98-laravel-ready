<?php

use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: SessionsCoreModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->string(column: 'id')->primary();
                $table->foreignId(column: 'user_id')->nullable()->index();
                $table->string(column: 'ip_address', length: 45)->nullable();
                $table->text(column: 'user_agent')->nullable();
                $table->longText(column: 'payload');
                $table->integer(column: 'last_activity')->index();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: SessionsCoreModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
