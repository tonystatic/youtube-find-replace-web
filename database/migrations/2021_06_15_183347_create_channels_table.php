<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    public function up() : void
    {
        Schema::create('channels', function (Blueprint $table) : void {
            $table->id();

            $table->string('external_id', 24)->unique();
            $table->string('title');
            $table->string('avatar')->nullable();

            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('channels');
    }
}
