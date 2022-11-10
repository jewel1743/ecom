<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('name');
            $table->string('unions')->nullable()->after('address');
            $table->string('upazila')->nullable()->after('unions');
            $table->string('district')->nullable()->after('upazila');
            $table->string('division')->nullable()->after('district');
            $table->string('pincode')->nullable()->after('division');
            $table->string('mobile')->nullable()->after('pincode');
            $table->tinyInteger('status')->default(1)->after('password');
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
            $table->dropColumn('address');
            $table->dropColumn('unions');
            $table->dropColumn('upazila');
            $table->dropColumn('district');
            $table->dropColumn('division');
            $table->dropColumn('pincode');
            $table->dropColumn('mobile');
            $table->dropColumn('status');
        });
    }
}
