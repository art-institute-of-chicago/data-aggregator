<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'artist_product' => [
            'product_shop_id' => 'product_id',
        ],
        'artwork_product' => [
            'product_shop_id' => 'product_id',
        ],
        'exhibition_product' => [
            'product_shop_id' => 'product_id',
        ],
        'products' => [
            'shop_id' => 'id',
        ],
    ];

    protected $indexes = [
        'artist_product' => [
            'artist_product_product_shop_id_index' => 'artist_product_product_id_index',
        ],
        'artwork_product' => [
            'artwork_product_product_shop_id_index' => 'artwork_product_product_id_index',
        ],
        'exhibition_product' => [
            'exhibition_product_product_shop_id_index' => 'exhibition_product_product_id_index',
        ],
    ];
};
