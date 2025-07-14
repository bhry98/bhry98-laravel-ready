<?php

use Bhry98\Helpers\models\LocalizationsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new LocalizationsModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('relation');
                $table->string('column_name');
                $table->string('locale');
                $table->string('value');
                $table->string('reference_id');
                bhry98_common_database_columns(table: $table, softDeletes: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new LocalizationsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};