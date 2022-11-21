<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOtherFaqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('content_to_consult', 500);
            $table->string('consulting_content', 500);
            $table->timestamp('created_date')->useCurrent();
            $table->tinyInteger('status')->nullable();
            $table->string('email', 50);
            $table->string('phone', 20)->nullable();
            $table->string('type_of_service_id', 3)->index();
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
        Schema::dropIfExists('other_faqs');
    }
}
