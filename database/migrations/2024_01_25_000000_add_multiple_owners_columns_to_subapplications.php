<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('subapplications', function (Blueprint $table) {
            $table->string('fileno')->nullable();
            $table->json('multiple_owners_names')->nullable();
            $table->json('multiple_owners_passport')->nullable();
            $table->json('multiple_owners_data')->nullable();
        });
    }

    public function down()
    {
        Schema::table('subapplications', function (Blueprint $table) {
            $table->dropColumn(['fileno', 'multiple_owners_names', 'multiple_owners_passport', 'multiple_owners_data']);
        });
    }
};
