<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuestionAswerService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_aswer_service', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('consulting_content', 200);
            $table->timestamp('created_date')->useCurrent();
            $table->bigInteger('view')->default(0);
            $table->string('type_of_service_id')->index();
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
        Schema::dropIfExists('question_aswer_service');
    }
}
