<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class ViewProduct extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get all of the comments for the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageItems(): HasMany
    {
        // foreign_key là khóa ngoại của bảng image_item,
        //nếu không chỉ định thì nó dựa theo tên class ViewProduct để chỉ định khóa ngoại mặc định
        //vd: view_product_id
        return $this->hasMany(ImageItem::class, 'product_id');
    }

    /**
     * Get all of the comments for the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        // foreign_key là khóa ngoại của bảng image_item,
        //nếu không chỉ định thì nó dựa theo tên class ViewProduct để chỉ định khóa ngoại mặc định
        //vd: view_product_id
        return $this->hasMany(Comment::class, 'product_id');
    }
}
