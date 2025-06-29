<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\enums\{
    EnumsCoreModel,
};

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: EnumsCoreModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string('code')->index()->unique();
                $table->string('type');
                $table->string('default_name')->nullable();
                $table->string('default_color')->default('gray');
                $table->integer('ordering')->default(1);
                $table->boolean('api_access')->default(false);
                $table->boolean('can_delete')->default(true);
                $table->boolean('default')->default(false);
                $table->foreignId('parent_id')->nullable()->references('id')->on(EnumsCoreModel::TABLE_NAME)->cascadeOnDelete()->cascadeOnUpdate();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: EnumsCoreModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
