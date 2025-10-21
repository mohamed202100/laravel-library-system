<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GitHubController extends Controller
{
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'github_id' => $githubUser->getId(),
                'avatar' => $githubUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
