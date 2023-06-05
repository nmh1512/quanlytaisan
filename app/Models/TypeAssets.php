<?php

namespace App\Models;

use App\Traits\HasUserCreatedTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAssets extends Model
{
    use HasFactory, SoftDeletes, HasUserCreatedTrait;

    protected $fillable = [
        'name',
        'category_asset_id',
        'model',
        'brand',
        'year_create',
        'unit',
        'image',
        'user_create'
    ];

    public function categoryAsset() {
        return $this->belongsTo(CategoryAssets::class, 'category_asset_id');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('H:i:s, d/m/Y');
    }
    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('H:i:s, d/m/Y');
    }
   
}
