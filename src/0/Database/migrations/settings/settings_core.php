<?php

use Bhry98\Bhry98LaravelReady\Models\settings\SettingsCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(SettingsCoreModel::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->unique()->index();
            $table->longText('value')->nullable();
        });
    }
};
