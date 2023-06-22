<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class SocialAuthController extends Controller
{
    //
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialiteProfile = Socialite::driver($provider)->user();
        $user = User::where('email', $socialiteProfile->email)->first();
        //lấy thông tin username, email, avatar, social_id để lưu vào bảng users

        $data = [
            'name' => $socialiteProfile->name,
            'email' => $socialiteProfile->email,
            // 'avatar_url' => optional($user)->avatar_url ? $user->avatar_url : $socialiteProfile->avatar,
            'social_provider' => $provider,
            'social_id' => $socialiteProfile->id,
        ];
        $user = User::updateOrCreate(
            ['email' => $socialiteProfile->email],
             $data);

        Auth::login($user, true);

        return redirect('/');
    }
}
