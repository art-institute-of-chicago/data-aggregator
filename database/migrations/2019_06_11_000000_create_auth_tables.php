<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTables extends Migration
{
    private $schema;

    /**
     * Use custom connection for these tables to ensure that they
     * don't get reset when we version our data using prefixes.
     */
    public function __construct()
    {
        $this->schema = Schema::connection('mysql_userdata');
    }

    public function up()
    {
        $this->down();

        $this->schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $this->schema->create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id');
            $table->unsignedInteger('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        $this->schema->create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id')->index()->nullable();
            $table->unsignedInteger('client_id');
            $table->string('name')->nullable();
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        $this->schema->create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('access_token_id', 100)->index();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        $this->schema->create('oauth_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->nullable();
            $table->string('name');
            $table->string('secret', 100);
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
        });

        $this->schema->create('oauth_personal_access_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('users');
        $this->schema->dropIfExists('oauth_auth_codes');
        $this->schema->dropIfExists('oauth_access_tokens');
        $this->schema->dropIfExists('oauth_refresh_tokens');
        $this->schema->dropIfExists('oauth_clients');
        $this->schema->dropIfExists('oauth_personal_access_clients');
    }
}
