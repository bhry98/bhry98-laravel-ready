<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\localizations\LocalizationsModel;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: LocalizationsModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'relation');
                $table->string(column: 'column_name');
                $table->string(column: 'locale');
                $table->string(column: 'value');
                $table->string(column: 'reference_id');
                bhry98_common_database_columns(table: $table, softDeletes: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: LocalizationsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
