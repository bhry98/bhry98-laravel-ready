<?php

use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsPersonalAccessTokenModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            table: SessionsPersonalAccessTokenModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->morphs(name: 'tokenable', indexName: "core_sessions_personal_access_tokenable");
                $table->string(column: 'name');
                $table->string(column: 'token', length: 64)->unique(indexName: "core_sessions_access_token");
                $table->text(column: 'abilities')->nullable();
                $table->timestamp(column: 'last_used_at')->nullable();
                $table->timestamp(column: 'expires_at')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: SessionsPersonalAccessTokenModel::TABLE_NAME);
    }
};
