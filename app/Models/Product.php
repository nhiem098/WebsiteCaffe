<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['active', 'code', 'name', 'slug', 'summary', 'description', 'price', 'category_id', 'avatar', 'note'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
