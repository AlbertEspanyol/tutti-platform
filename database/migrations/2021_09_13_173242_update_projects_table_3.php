<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProjectsTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('budget', 15, 8)->change();
            $table->decimal('currentCash', 15, 8)->change();
            $table->longText('introduction')->change();
            $table->longText('description')->change();
            $table->longText('partnerConditions')->change();
            $table->longText('investmentNeeds')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
