<?php
namespace App\Traits;

use App\Models\User;

trait HasUserCreatedTrait {
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'user_create');
    }
}

?>