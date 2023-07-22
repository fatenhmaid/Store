<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            //id BIGINT UNSIGNED AUTO INCREMENT PRIMARY
           // $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
           // $table->unsignedBigInteger('id')->autoIncrement()->primary();
           // $table->bigIncrements('id')->primary();

            $table->id();
            $table->string('name',100);//varchar(64000)
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_image')->nulable();
            $table->string('cover_image')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
          //  $table->uuid('id');
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
