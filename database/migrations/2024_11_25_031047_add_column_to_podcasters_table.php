<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('podcasters', function (Blueprint $table) {
            $table->unique('email');

            $table->date('email_verified_at')->nullable();
            $table->rememberToken();       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('podcasters', function (Blueprint $table) {
            $table->dropUnique(['email']); 
            $table->dropColumn(['email_verified_at', 'remember_token']);
        });
    }
};
