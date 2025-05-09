<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\users\{
    UsersAzureUsersModel,
    UsersCoreUsersModel
};
return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: UsersAzureUsersModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->uuid(column: 'identity_code')->unique();
                $table->string(column: 'azure_user_id')->unique();
                $table->string(column: 'given_name', length: 100)->nullable();
                $table->string(column: 'surname', length: 100)->nullable();
                $table->string(column: 'display_name', length: 200);
                $table->boolean(column: 'account_enabled');
                $table->string(column: 'mail', length: 200)->nullable();
                $table->string(column: 'user_type', length: 50);
                $table->string(column: 'job_title', length: 100)->nullable();
                $table->string(column: 'department', length: 100)->nullable();
                $table->string(column: 'company_name', length: 100)->nullable();
                $table->string(column: 'employee_id', length: 100)->nullable();
                $table->string(column: 'employee_type', length: 100)->nullable();
                $table->string(column: 'employee_hire_date', length: 100)->nullable();
                $table->string(column: 'office_location', length: 100)->nullable();
                $table->string(column: 'street_address', length: 200)->nullable();
                $table->string(column: 'city', length: 100)->nullable();
                $table->string(column: 'state', length: 100)->nullable();
                $table->string(column: 'postal_code', length: 20)->nullable();
                $table->string(column: 'country', length: 100)->nullable();
                $table->string(column: 'mobile_phone', length: 50)->nullable();
                $table->string(column: 'fax_number', length: 50)->nullable();
                $table->json(column: 'business_phones')->nullable();
                $table->json(column: 'other_mails')->nullable();
                $table->timestamp(column: 'created_at')->useCurrent();
                $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
                $table->softDeletes();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: UsersAzureUsersModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
