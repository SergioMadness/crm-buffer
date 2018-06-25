<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('client_id');
            $table->string('client_secret');
            $table->unique(['client_id', 'client_secret']);
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('applications')->insert([
            'id'            => \Ramsey\Uuid\Uuid::uuid4(),
            'name'          => 'Test',
            'client_id'     => 1,
            'client_secret' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applications');
    }
}
