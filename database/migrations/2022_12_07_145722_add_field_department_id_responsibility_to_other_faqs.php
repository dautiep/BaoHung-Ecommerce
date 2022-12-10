<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDepartmentIdResponsibilityToOtherFaqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_faqs', function (Blueprint $table) {
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
        Schema::table('other_faqs', function (Blueprint $table) {
            $table->dropColumn('department_id_responsibility');
        });
    }
}
