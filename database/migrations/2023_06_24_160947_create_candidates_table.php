<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institute_id')->unsigned()->nullable();
            $table->string('camp');
            $table->string('activity');
            $table->string('sr_no');
            $table->string('regiment_no');
            $table->string('name');
            $table->string('rank');
            $table->string('contact_no');
            $table->timestamps();

            $table->foreign('institute_id')
                ->references('id')->on('institutes')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
