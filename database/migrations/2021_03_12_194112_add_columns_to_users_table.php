<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('role')->default("employee");
            $table->string("photo")->default('default_picture.png')->nullable();
            $table->integer("age");
            $table->integer("department_id")->nullable();
            $table->float("salary")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('role');
            $table->dropColumn('photo');
            $table->dropColumn('age');
            $table->dropColumn('department_id');
            $table->dropColumn('salary');
        });
    }
}
