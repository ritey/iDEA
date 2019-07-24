<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('enabled')->index()->default(0);
            $table->integer('category_id')->index()->nullable();
            $table->integer('sort_order')->index()->default(0);
            $table->integer('complete_count')->index()->default(0);
            $table->timestamps();
            $table->string('name');
            $table->string('image_path')->nullable();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('enabled')->index()->default(0);
            $table->integer('sort_order')->index()->default(0);
            $table->timestamps();
            $table->string('name');
        });

        $categories = [];
        $categories[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'Citizen', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        $categories[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'Worker', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        $categories[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'Maker', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        $categories[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'Entrepreneur', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        $categories[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'Gamer', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        $categories[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'Independent', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];


        for($i=1;$i<=count($categories);$i++) {
            $categories[($i-1)]['id'] = $i;
        }

        DB::table('categories')->insert($categories);

        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('enabled')->index()->default(0);
            $table->integer('sort_order')->index()->default(0);
            $table->timestamps();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('locale')->nullable();
            $table->string('image_path')->nullable();
        });

        $languages = [];
        $languages[] = ['id' => '', 'enabled' => '1', 'sort_order' => '0', 'name' => 'English', 'code' => 'en', 'locale' => 'en_US.UTF-8,en_US,en-gb,english', 'image_path' => 'gb.png', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];

        for($i=1;$i<=count($languages);$i++) {
            $languages[($i-1)]['id'] = $i;
        }

        DB::table('languages')->insert($languages);

        Schema::create('language_strings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('enabled')->index()->default(0);
            $table->integer('language_id')->index()->nullable();
            $table->timestamps();
            $table->string('group');
            $table->string('name');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badges');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('language_strings');
    }
}
