<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name',
                           'iva',];

                           protected static function boot(){
                               parent::boot();
                               self::creating(function ($table){
                                   if (!app()->runningInConsole()){
                                       $table->user_id = auth()->id();
                                   }
                               });
                           }
    
                           public function product()
                           {
                               return $this->hasMany(Product::class);
                           }
                           
}
