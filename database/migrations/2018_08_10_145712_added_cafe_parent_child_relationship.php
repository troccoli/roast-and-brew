<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedCafeParentChildRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function (Blueprint $table) {
            $table->unsignedInteger('parent')->nullable();
            $table->string('location_name')->default('');
            $table->integer('roaster')->nullable();
            $table->text('website')->nullable();
            $table->text('description')->default('');
            $table->unsignedInteger('added_by')->nullable();

            $table->foreign('parent')->references('id')->on('cafes');
            $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafes', function (Blueprint $table) {
            $table->dropColumn(['parent', 'location_name', 'roaster', 'website', 'description', 'added_by']);
        });
    }
}
