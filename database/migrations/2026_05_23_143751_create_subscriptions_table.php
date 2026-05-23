<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // New table "subscriptions"
        // - id int(11) auto_increment primary key
        // - user_id int(11) not null (foreign key to users table N:1 - one user can have many tasks)
        // - stripe_id varchar(50) not null
        // - status varchar(255) not null
        // - price_id bigint(20) not null
        // - end_at datetime null
        // - created_at datetime not null
        // - updated_at datetime not null

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('stripe_id', 50);
            $table->string('status', 255);
            $table->bigInteger('price_id');
            $table->datetime('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
