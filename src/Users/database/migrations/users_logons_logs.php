<?php

use Bhry98\Users\Models\UsersAuthenticationLogModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create((new UsersAuthenticationLogModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->morphs('authenticatable', "users_authenticatable_logs");;
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamp('login_at')->nullable();
                $table->boolean('login_successful')->default(false);
                $table->timestamp('logout_at')->nullable();
                $table->boolean('cleared_by_user')->default(false);
                $table->json('location')->nullable();
            });
        Schema::enableForeignKeyConstraints();

    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists((new UsersAuthenticationLogModel)->getTable());
        Schema::enableForeignKeyConstraints();

    }
};
