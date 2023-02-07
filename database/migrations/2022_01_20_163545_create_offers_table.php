<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code')->nullable();
            $table->smallInteger('vacant_positions');
            $table->string('priority');
            $table->text('description')->nullable();
            $table->json('requirements');
            
            $table->datetime('subscriptionStartDate');
            $table->datetime('subscriptionEndDate')->nullable();
            $table->datetime('activityStartDate')->nullable();
            $table->datetime('activityEndDate')->nullable();
            $table->boolean('subscribable')->default(false);
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
        Schema::dropIfExists('offers');
    }
}
