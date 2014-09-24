<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuilderTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the client table
                Schema::create('client', function ($table) {
                    $table->increments('id')->unsigned();
                    $table->string('name')->unique();
                    
                });
                
                // Creates the property table (1-to-Many relation with client (client can have many properties)
                Schema::create('property', function ($table) {
                $table->increments('id')->unsigned();
                 $table->string('name')->unique();
                $table->integer('client_id')->unsigned();
                $table->foreign('client_id')->references('id')->on('client');
              });
              
               // Creates the google account (1-to-1 relation with property table)
                Schema::create('google_account', function ($table) {
                $table->increments('id')->unsigned();
                $table->string('oauth_client_id')->unique();
                $table->string('oauth_email')->unique();
                $table->string('oauth_client_secret')->unique();
                $table->string('oauth_redirect_url')->unique();
                $table->string('oauth_javascript_origins')->unique();
                $table->integer('property_id')->unsigned();
                $table->foreign('property_id')->references('id')->on('property');
                
              });
              // Creates the url table (1-to-N relation with google account table)
                Schema::create('url_data', function ($table) {
                $table->increments('id')->unsigned();
                $table->string('long_url');
                $table->string('subject_line');
                $table->string('short_url');
                $table->string('original_url');
                $table->string('notes');
                $table->string('partner');
                $table->string('message');
                $table->string('wmj_job_number');
                $table->string('compaign_medium');
                $table->string('compaign_source');
                $table->string('compaign_content');
                $table->string('compaign_name');
                $table->integer('google_account_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->timestamps();
                $table->foreign('google_account_id')->references('id')->on('google_account');
                
              });
              // Creates the URL analytics table (1-to-N relation with url data  table)
                Schema::create('url_analytics', function ($table) {
                $table->increments('id')->unsigned();
                $table->string('raw_data');
                $table->integer('daily_total')->unsigned();
                $table->integer('url_data_id')->unsigned();
                $table->dateTime('pulled_at');
                $table->foreign('url_data_id')->references('id')->on('url_data');
                
              });
            }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::table('property', function (Blueprint $table) {
                    $table->dropForeign('property_client_id_foreign');
                    
                });

                Schema::table('google_account', function (Blueprint $table) {
                    $table->dropForeign('google_account_property_id_foreign');
                    
                });
                
                Schema::table('url_data', function (Blueprint $table) {
                    $table->dropForeign('url_data_google_account_id_foreign');
                    
                });
                
                Schema::table('url_analytics', function (Blueprint $table) {
                    $table->dropForeign('url_analytics_url_data_id_foreign');
                    
                });

                Schema::drop('client');
                Schema::drop('property');
                Schema::drop('google_account');
                Schema::drop('url_data');
                Schema::drop('url_analytics');
        }
	

}
