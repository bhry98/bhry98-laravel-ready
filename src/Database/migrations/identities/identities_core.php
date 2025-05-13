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
                $table->foreignId(column: 'parent_id')->nullable()->references(column: 'id')->on(table: IdentitiesCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->string(column: 'type');
                $table->string(column: 'module');
                $table->string(column: 'name')->nullable();
                $table->json(column: 'metadata')->nullable();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
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
