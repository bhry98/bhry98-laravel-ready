<?php

use Bhry98\Users\Models\UsersPersonalAccessTokenModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new UsersPersonalAccessTokenModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->morphs('tokenable', "core_sessions_personal_access_tokenable");
                $table->string('name');
                $table->string('token', 64)->unique("core_sessions_access_token");
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new UsersPersonalAccessTokenModel)->getTable());
    }
};
