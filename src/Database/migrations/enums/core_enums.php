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
                $table->string(column: 'code')->index()->unique();
                $table->string(column: 'type');
                $table->string(column: 'module');
                $table->string(column: 'default_name')->nullable();
                $table->string(column: 'default_color')->default('gray');
                $table->boolean(column: 'api_access')->default(value: false);
                $table->boolean(column: 'can_delete')->default(value: true);
                $table->foreignId(column: 'parent_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table:  EnumsCoreModel::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->softDeletes();
                $table->timestamps();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table:  EnumsCoreModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
