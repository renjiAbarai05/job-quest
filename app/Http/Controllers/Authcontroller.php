<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class Authcontroller extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        if (auth()->attempt($credentials, $remember)) {
            return redirect()->intended('/');
        } else {
            return back()->with(
                'error', 'Invalid credentials'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        try {
            $githubUser = Socialite::driver($provider)->user();

            // Check if the user already exists
            $user = User::where('provider', 'github')
                        ->where('provider_id', $githubUser->getId())
                        ->first();

            if (!$user) {
                // Create a new user if not found
                $user = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'provider' => 'github',
                    'provider_id' => $githubUser->getId(),
                    'password' => Hash::make('password'), // Set a default password or use null
                ]);
            }

            // Log in the user
            Auth::login($user);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Failed to login with GitHub');
        }
    }
}
