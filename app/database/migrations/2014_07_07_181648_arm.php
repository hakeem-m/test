<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ceniack extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('urls', function($table)
            {
                $table->increments('id');
                $table->string('description', 128);
                $table->string('original_url', 128);
                $table->string('short_url', 128);
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
		Schema::drop('urls');
	}

}
