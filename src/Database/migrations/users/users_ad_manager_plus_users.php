<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use  Bhry98\Bhry98LaravelReady\Models\users\{
    UsersADManagerUsersModel,
    UsersCoreUsersModel
};

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: UsersADManagerUsersModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->uuid(column: 'identity_code')->unique();
                $table->string(column: 'distinguished_name');
                $table->string(column: 'domain_name');
                $table->string(column: 'ou_name');
                $table->string(column: 'sid_string')->nullable();
                $table->string(column: 'object_guid')->nullable()->unique();
                $table->string(column: 'sam_account_name');
                $table->string(column: 'logon_name')->nullable();
                $table->string(column: 'employee_id', length: 100)->nullable();
                $table->string(column: 'initial')->nullable();
                $table->string(column: 'first_name')->nullable();
                $table->string(column: 'last_name')->nullable();
                $table->string(column: 'display_name')->nullable();
                $table->string(column: 'city')->nullable();
                $table->string(column: 'country')->nullable();
                $table->string(column: 'email_address')->nullable();
                $table->string(column: 'street_address')->nullable();
                $table->string(column: 'mobile')->nullable();
                $table->boolean(column: 'account_enabled')->default(value: true);
                $table->timestamp(column: 'created_at')->useCurrent();
                $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
                $table->softDeletes();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: UsersADManagerUsersModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
