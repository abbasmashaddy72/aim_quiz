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
        Schema::table('topics', function (Blueprint $table) {
            $table->string('declaration')->nullable()->after('age_restriction');
            $table->bigInteger('count')->nullable()->after('title');
            $table->date('start')->nullable()->after('count');
            $table->date('end')->nullable()->after('start');
            $table->string('matter')->nullable()->after('declaration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('declaration');
            $table->dropColumn('count');
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->dropColumn('matter');
        });
    }
};
