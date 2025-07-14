<?php

use Bhry98\Settings\Models\SettingsEnumsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new SettingsEnumsModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code')->index()->unique();
                $table->string('type');
                $table->string('model')->nullable();
                $table->string('default_name')->nullable();
                $table->string('default_description')->nullable();
                $table->string('icon')->nullable();
                $table->string('color')->default('#808080');
                $table->integer('ordering')->default(1);
                $table->foreignId('parent_id')->nullable()->references('id')->on((new SettingsEnumsModel)->getTable())->cascadeOnDelete()->nullOnDelete();
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new SettingsEnumsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
