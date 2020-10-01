<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDelivery extends Migration
{


    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->decimal('price', 8, 2)->nullable();
            $table->boolean('hidden')->default(0);

        });
    }

       public function down()
    {
        Schema::dropIfExists('delivery');
    }

}
