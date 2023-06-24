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
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->after('id', function () use ($table) {
                $table->string('first_name');
                $table->string('last_name');
            });
            $table->after('image', function () use ($table) {
                $table->string('gender');
                $table->string('post_office');
                $table->string('city');
                $table->string('nationality');
                $table->string('social_security_code');
                $table->string('language');
                $table->integer('lease_payments');
                $table->text('how_find_us');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('post_office');
            $table->dropColumn('city');
            $table->dropColumn('nationality');
            $table->dropColumn('social_security_code');
            $table->dropColumn('language');
            $table->dropColumn('lease_payments');
            $table->dropColumn('how_find_us');
        });
    }
};
