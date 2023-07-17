<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {  //criação da tabela SQL
            $table->id();
            $table->timestamps();
            $table->string("title");   
            $table->text("description");
            $table->string("city");
            $table->boolean("private");
                                        //dados inseridos,usar php artisan migrate:status
                                        //depois php artisan migrate para migrar os dados para a tabela
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
