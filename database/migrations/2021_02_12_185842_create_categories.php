<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rozetka_id');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            [
                'name' => 'Геймерські',
                'rozetka_id' => 'game'
            ],
            [
                'name' => 'Для бізнесу',
                'rozetka_id' => 'dlya-biznesa'
            ],
            [
                'name' => 'Для роботи та навчання',
                'rozetka_id' => 'workteaching'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
