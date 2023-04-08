<?php

namespace App\Models;

use App\Models\ItemOut;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'item_category_id',
        'unit',
        'amount',        
    ];

    public function category(){
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }
    
    public function getItemOutAttribute()
    {
        return ItemOut::where('item_id' , $this->attributes['id'])->get()->sum('amount');
    }
}
