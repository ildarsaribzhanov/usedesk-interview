<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients_emails', function (Blueprint $table) {
            $table->unique('email');
        });

        Schema::table('clients_phones', function (Blueprint $table) {
            $table->unique('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients_emails', function (Blueprint $table) {
            $table->dropIndex('email');
        });

        Schema::table('clients_phones', function (Blueprint $table) {
            $table->dropIndex('phone');
        });
    }
}
