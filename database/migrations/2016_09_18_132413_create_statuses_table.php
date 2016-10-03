<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->text('body');
            $table->integer('item_id')->nullable();
            $table->integer('type')->nullable();
            $table->integer('image')->default('http://twotwentytwo.co.uk/dev/looksy/placeholder_image.png');
            $table->integer('title')->nullable();
            $table->integer('url')->nullable();
            $table->integer('description')->nullable();
            $table->integer('source')->nullable();
            $table->integer('review')->nullable();
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
        Schema::drop('statuses');
    }
}
