<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionFieldsToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->text('subscription_image')->nullable()
                ->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->decimal('price_15days', 10, 2)->default(0.00);
            $table->decimal('price_1month', 10, 2)->default(0.00);
            $table->decimal('price_6months', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['subscription_image', 'price_15days', 'price_1month', 'price_6months']);
        });
    }
}
