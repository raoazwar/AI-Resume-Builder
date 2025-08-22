<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(16)),
                'google_id' => $googleUser->id,
            ]);

            Auth::login($user);

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Google login failed. Please try again.']);
        }
    }

    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback()
    {
        try {
            $linkedinUser = Socialite::driver('linkedin')->user();
            
            $user = User::updateOrCreate([
                'email' => $linkedinUser->email,
            ], [
                'name' => $linkedinUser->name,
                'email' => $linkedinUser->email,
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(16)),
                'linkedin_id' => $linkedinUser->id,
            ]);

            Auth::login($user);

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'LinkedIn login failed. Please try again.']);
        }
    }
}
