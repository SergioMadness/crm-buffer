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
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('application_id');
            $table->jsonb('body');
            $table->enum('status', ['new', 'queue', 'need_another_attempt', 'success', 'failed'])->default('new');
            $table->jsonb('processing_info')->nullable();
            $table->enum('request_type', ['lead', 'user']);
            $table->text('response')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
            $table->foreign('application_id')
                ->on('applications')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requests');
    }
}
