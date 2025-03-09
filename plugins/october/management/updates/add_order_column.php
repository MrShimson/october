<?php namespace October\Management\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * AddOrderColumn Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::table('october_management_employees', function(Blueprint $table) {
            $table->addColumn('tinyInteger', 'order')->nullable(false)->default(1)->after('position');
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::table('october_management_employees', function(Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
