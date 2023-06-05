<?php

namespace App\Models;

use App\Traits\HasUserCreatedTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class CategoryAssets extends Model
{
    use HasFactory, SoftDeletes, HasUserCreatedTrait;

    protected $fillable = ['name', 'user_create'];

    public function getCreatedAtAttribute() {
        return date('H:i:s, d/m/Y', strtotime($this->attributes['created_at']));
    }
    public function getUpdateAtAttribute() {
        return date('H:i:s, d/m/Y', strtotime($this->attributes['update_at']));
    }
}
