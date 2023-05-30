<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAssets extends Model
{
    use HasFactory, SoftDeletes;

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

    public function userCreate() {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function categoryAsset() {
        return $this->belongsTo(CategoryAssets::class, 'category_asset_id');
    }

    public function getCreatedAtAttribute() {
        return date('H:i:s, d/m/Y', strtotime($this->attributes['created_at']));
    }
    public function getUpdateAtAttribute() {
        return date('H:i:s, d/m/Y', strtotime($this->attributes['update_at']));
    }
}
