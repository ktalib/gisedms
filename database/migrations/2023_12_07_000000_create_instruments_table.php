<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('fileNumber')->unique();
            $table->string('fileSuffix')->nullable();
            $table->string('particularsRegistrationNumber')->nullable();
            $table->string('instrumentName')->nullable();
            $table->string('GrantorName')->nullable();
            $table->string('GrantorAddress')->nullable();
            $table->string('GranteeName')->nullable();
            $table->string('GranteeAddress')->nullable();
            $table->string('mortgagorName')->nullable();
            $table->string('mortgagorAddress')->nullable();
            $table->string('mortgageeName')->nullable();
            $table->string('mortgageeAddress')->nullable();
            $table->decimal('loanAmount', 15, 2)->nullable();
            $table->decimal('interestRate', 5, 2)->nullable();
            $table->string('duration')->nullable();
            $table->string('assignorName')->nullable();
            $table->string('assignorAddress')->nullable();
            $table->string('assigneeName')->nullable();
            $table->string('assigneeAddress')->nullable();
            $table->string('lessorName')->nullable();
            $table->string('lessorAddress')->nullable();
            $table->string('lesseeName')->nullable();
            $table->string('lesseeAddress')->nullable();
            $table->string('leasePeriod')->nullable();
            $table->text('leaseTerms')->nullable();
            $table->text('propertyDescription')->nullable();
            $table->string('propertyAddress')->nullable();
            $table->string('originalPlotDetails')->nullable();
            $table->string('newSubDividedPlotDetails')->nullable();
            $table->string('mergedPlotInformation')->nullable();
            $table->string('surrenderingPartyName')->nullable();
            $table->string('receivingPartyName')->nullable();
            $table->text('propertyDetails')->nullable();
            $table->decimal('considerationAmount', 15, 2)->nullable();
            $table->text('changesVariations')->nullable();
            $table->text('heirBeneficiaryDetails')->nullable();
            $table->text('originalPropertyOwnerDetails')->nullable();
            $table->text('assentTerms')->nullable();
            $table->string('releasorName')->nullable();
            $table->string('releaseeName')->nullable();
            $table->text('releaseTerms')->nullable();
            $table->date('instrumentDate')->nullable();
            $table->string('solicitorName')->nullable();
            $table->string('solicitorAddress')->nullable();
            $table->string('surveyPlanNo')->nullable();
            $table->string('lgaDistrict')->nullable();
            $table->string('plotNumberSize')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruments');
    }
}
