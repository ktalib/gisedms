<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subapplications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_application_id')->constrained('mother_applications');
            $table->string('applicant_type');
            $table->string('applicant_title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('passport')->nullable();
            $table->string('corporate_name')->nullable();
            $table->string('rc_number')->nullable();
            $table->text('multiple_owners_names')->nullable();
            $table->text('multiple_owners_passport')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('identification_type');
            $table->string('identification_others')->nullable();
            $table->string('block_number');
            $table->string('floor_number');
            $table->string('unit_number');
            $table->text('property_location');
            $table->string('ownership');
            $table->string('application_status');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subapplications');
    }
};
