<?php

use Bhry98\Bhry98LaravelReady\Models\identities\IdentitiesCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: IdentitiesCoreModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->uuid(column: 'code')->unique();
                $table->foreignId(column: 'parent_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: IdentitiesCoreModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->string(column: 'type');
                $table->string(column: 'module');
                $table->string(column: 'name')->nullable();
                $table->json(column: 'metadata')->nullable();
                $table->boolean(column: 'is_active')->default(value: true);
                $table->timestamp(column: 'created_at')->useCurrent();
                $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
                $table->softDeletes();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: IdentitiesCoreModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
