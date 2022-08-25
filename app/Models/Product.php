<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
                           'id',
                           'sku',
                           'key_cva',
                           'title',
                           'disponible',
                           'group_cva',
                           'brands_id',
                           'disponible',
                           'condicion',
                           'availability',
                           'google_product_category',
                           'fb_product_category',
                           'link',
                           'ficha_tecnica',
                           'disponible_cd',
                           'image_link',
                           'precio',
                           'moneda',
                           'total',
                           'bonus',
                           'price',
                           'sale_price',
                           'iva',];

                           protected static function boot(){
                               parent::boot();
                               
                           }

                           public function brand()
                           {
                               return $this->hasOne(Brand::class);
                           }
}
