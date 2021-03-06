<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskinatorTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createBoardsTable();
        $this->createTListsTable();
        $this->createTasksTable();
        $this->createColorsTable();
        $this->createTagsTable();

        $this->createTagTaskTable();
    }

    private function createBoardsTable() {
        Schema::create('boards', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->unique();

            $table->boolean('archived')->default(0);
            $table->timestamps();
        });
    }

    private function createTListsTable() {
        Schema::create('t_lists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->bigInteger('board_id')->unsigned();
            $table->unsignedInteger('sort');

            $table->boolean('archived')->default(0);
            $table->timestamps();

            $table->foreign('board_id')->references('id')->on('boards');
            $table->unique(['board_id', 'sort']);
        });
    }

    private function createTasksTable() {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->bigInteger('t_list_id')->unsigned()->nullable();
            $table->unsignedInteger('sort')->nullable();

            $table->boolean('archived')->default(0);
            $table->timestamps();

//            $table->foreign('t_list_id')->references('id')->on('t_lists')->nullable();
            $table->unique(['t_list_id', 'sort']);
        });
    }

    private function createTagsTable() {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->bigInteger('color_id')->unsigned();

            $table->boolean('archived')->default(0);
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('colors');
            $table->unique(['name','color_id']);
        });
    }

    private function createTagTaskTable() {
        Schema::create('tag_task', function (Blueprint $table) {
            $table->bigInteger('task_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();

            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('tag_id')->references('id')->on('tags');

            $table->unique(['task_id','tag_id']);
        });
    }

    private function createColorsTable() {
        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('hex', 6);

            $table->boolean('archived')->default(0);
 //           $table->timestamps();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
//            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->unique(['name','hex']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_task');

        Schema::dropIfExists('tasks');
        Schema::dropIfExists('t_lists');
        Schema::dropIfExists('boards');


        Schema::dropIfExists('tags');

        Schema::dropIfExists('colors');


    }
}
