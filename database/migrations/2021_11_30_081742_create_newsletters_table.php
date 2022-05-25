<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("newsletters", function (Blueprint $table) {
      $table->id();
      $table->string("name");
      $table->text("subject");
      $table->bigInteger("template_id")->nullable();
      $table->longText("body")->nullable();
      $table->text("attachments")->nullable();
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
    Schema::dropIfExists("newsletters");
  }
}
