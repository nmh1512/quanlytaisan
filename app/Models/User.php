<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['select_role'];

    public function getSelectRoleAttribute()
    {
        if(!Auth::user()->hasPermissionTo('users edit')) {
            return $this->roles->first()->name ?? '';
        }
        $userId = $this->attributes['id'];
        $roleId = $this->roles->first()->id ?? '';
        $html = "
            <select data-id='$userId' class='select-roles' data-href='".route('home.set-role', ['user' => $userId])."' data-action='set-role' data-placeholder='Chọn chức vụ'>
                <option value=''></option>
        ";
        $roles = Cache::get('roles');
        if (empty($roles)) {
            $roles = Role::orderBy('id', 'DESC')->get();
            Cache::set('roles', $roles);
        }
        foreach ($roles as $role) {
            $selected = $role->id == $roleId ? 'selected' : '';
            $html .= "<option $selected value='".$role->id."'>" . $role->name . "</option>";
        }
        $html .= "</select>";
        return $html;
    }
}
