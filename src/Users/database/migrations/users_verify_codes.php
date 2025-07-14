<?php


use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\Users\Models\UsersVerifyCodesModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new UsersVerifyCodesModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->integer('verify_code');
                $table->string('type');
                $table->foreignId('user_id')->references('id')->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamp('expired_at')->nullable();
                $table->boolean('valid')->default(true);
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new UsersVerifyCodesModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
