<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('projects');
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('subtitle');
            $table->string('location');
            $table->integer('members');
            $table->float('financedState');
            $table->float('projectState');
            $table->boolean('needInvestment');
            $table->boolean('needRecruitment');
            $table->float('stake');
            $table->float('budget');
            $table->float('currentCash');
            $table->string('tags');
            $table->string('images');
            $table->boolean('isOnline');
            $table->string('introduction');
            $table->string('description');
            $table->string('partnerConditions');
            $table->string('investmentNeeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
