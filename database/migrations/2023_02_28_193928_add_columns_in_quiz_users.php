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
        Schema::table('quiz_users', function (Blueprint $table) {
            $table->string('unique_id')->nullable()->after('id');
            $table->enum('gender', ['Male', 'Female'])->default('Male')->after('name');
            $table->boolean('aic')->default(0)->after('mobile');
            $table->renameColumn('age', 'dob');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_users', function (Blueprint $table) {
            $table->dropColumn('unique_id');
            $table->dropColumn('gender');
            $table->dropColumn('aic');
            $table->renameColumn('dob', 'age');
        });
    }
};
