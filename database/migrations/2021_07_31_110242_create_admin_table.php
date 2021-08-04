<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->string('username', 190)->unique()->comment('用户名');
            $table->string('password', 60)->comment('密码');
            $table->string('name')->comment('名称');
            $table->string('avatar')->nullable()->comment('头像');
            $table->text('permissions')->nullable()->comment('用户权限');
            $table->string('remember_token', 100)->nullable()->comment('Token');
            $table->softDeletes()->comment('软删除');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_users` comment'后台用户表'"); // 表注释

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->string('name', 50)->unique()->comment('角色名称');
            $table->string('slug', 50)->unique()->comment('角色标识');
            $table->text('permissions')->nullable()->comment('角色权限');
            $table->softDeletes()->comment('软删除');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_roles` comment'后台角色表'"); // 表注释

        Schema::create('admin_role_users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->index()->comment('关联角色');
            $table->unsignedBigInteger('user_id')->index()->comment('关联用户');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_role_users` comment'后台角色用户关联表'"); // 表注释

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->integer('group')->default(0)->comment('分组');
            $table->integer('parent_id')->default(0)->comment('父级ID');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('title', 50)->comment('标题');
            $table->string('icon', 50)->comment('图标');
            $table->string('uri')->nullable()->comment('地址');
            $table->softDeletes()->comment('软删除');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_menus` comment'后台菜单表'"); // 表注释

        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->unsignedBigInteger('user_id')->index()->comment('关联用户');
            $table->string('operate')->comment('操作');
            $table->string('path')->comment('路径');
            $table->string('method', 10)->comment('方法');
            $table->string('ip')->comment('IP');
            $table->text('input')->comment('请求内容');
            $table->softDeletes()->comment('软删除');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin_logs` comment'后台日志表'"); // 表注释

        Schema::table('admin_role_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('admin_users');
            $table->foreign('role_id')->references('id')->on('admin_roles');
        });

        Schema::table('admin_logs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('admin_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_role_users');
        Schema::dropIfExists('admin_menus');
        Schema::dropIfExists('admin_logs');
    }
}
