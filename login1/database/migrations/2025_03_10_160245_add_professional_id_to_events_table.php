<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfessionalIdToEventsTable extends Migration
{
  public function up()
  {
    Schema::table('events', function (Blueprint $table) {
      $table->unsignedBigInteger('professional_id')->after('id'); // assuming 'id' is a column in your table
      $table->foreign('professional_id')->references('id')->on('professionals')->onDelete('cascade');
    });
  }

  public function down()
  {
    Schema::table('events', function (Blueprint $table) {
      $table->dropForeign(['professional_id']);
      $table->dropColumn('professional_id');
    });
  }
}
