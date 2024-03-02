<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ViewProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;  
    
    
    public function product()
    {
        return $this->belongsTo(ViewProduct::class, 'product_id');
    } 
}
