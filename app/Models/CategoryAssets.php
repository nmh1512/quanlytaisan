<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class CategoryAssets extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'user_create'];

    public function userCreated() {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function getFormattedCreatedAtAttribute() {
        return date('H:i:s, d/m/Y', strtotime($this->attributes['created_at']));
    }
}
