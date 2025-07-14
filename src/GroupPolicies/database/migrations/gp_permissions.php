<?php

use Bhry98\GP\Models\GPPermissionsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new GPPermissionsModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code')->index()->unique();
                $table->string('default_name')->nullable();
                $table->string('default_description')->nullable();
                $table->boolean('is_default')->default(false);
                bhry98_common_database_columns(table: $table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new GPPermissionsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
