<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW product_variation_views 
            AS
            SELECT 
                product_variations.id, 
                product_variations.product_id, 
                product_variations.variation_id, 
                variations.variation_name, 
                variations.variation_category_id, 
                variation_categories.variation_category_name, 
                product_variations.original_price, 
                product_variations.sale_price, 
                product_variations.regular_price, 
                product_variations.discount, 
                product_variations.status, 
                product_variations.stock_qty, 
                product_variations.user_id, 
                product_variations.delete_user, 
                product_variations.created_at AS created_at, 
                product_variations.updated_at AS updated_at  
            FROM 
                product_variations
                LEFT JOIN variations ON variations.variation_id = product_variations.variation_id
                LEFT JOIN variation_categories ON variation_categories.variation_category_id = variations.variation_category_id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("DROP VIEW IF EXISTS `product_variation_views`;");
    }
};
