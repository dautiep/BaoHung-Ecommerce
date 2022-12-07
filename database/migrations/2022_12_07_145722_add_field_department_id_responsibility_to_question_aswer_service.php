<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDepartmentIdResponsibilityToQuestionAswerService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_aswer_service', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id_responsibility')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_aswer_service', function (Blueprint $table) {
            $table->dropColumn('department_id_responsibility');
        });
    }
}
