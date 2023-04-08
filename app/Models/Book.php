<?php

namespace App\Models;

use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'location',
        'stock',
        'author_id',
        'category_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }
}
