<?php namespace Linkonoid\UniDoc\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * @package linkonoid\unidoc
 * @author Linkonoid (https://linkonoid.com)
**/

class LinkonoidUnidocTables extends Migration
{
    public function up()
    {
        Schema::create('linkonoid_unidoc_files', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned()->unique();
            $table->string('hash')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('linkonoid_unidoc_files');
    }
}

