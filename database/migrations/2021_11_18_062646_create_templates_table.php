<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateTemplatesTable extends Migration
{
  /**
   * Run the migrations.
   *php
   * @return void
   */
  public function up()
  {
    Schema::create("templates", function (Blueprint $table) {
      $table->id();
      $table->string("template_name");
      $table->text("template_style");
      $table->text("header_text")->nullable();
      $table->text("custom_style")->nullable();
      $table->text("footer_text")->nullable();
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
    Schema::dropIfExists("templates");
  }
}
