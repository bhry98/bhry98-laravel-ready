<?php


use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsTemplateModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: UsersNotificationsTemplateModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'module');
                $table->string(column: 'type');
                $table->string(column: 'title');
                $table->longText(column: 'message');
                $table->longText(column: 'image')->nullable();
                $table->string(column: 'url');
                $table->string(column: 'icon')->nullable();
                $table->string(column: 'color')->nullable();
                $table->timestamp(column: 'created_at')->useCurrent();
                $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: UsersNotificationsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
