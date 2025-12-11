<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', Rule::in(['student', 'association', 'company'])],
            'date_of_birth' => ['nullable', 'date'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'date_of_birth' => $validated['date_of_birth'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route($this->onboardingRouteForRole($user->role));
    }

    private function onboardingRouteForRole(string $role): string
    {
        return match ($role) {
            'student' => 'onboarding.student.create',
            'association' => 'onboarding.association.create',
            'company' => 'onboarding.company.create',
            default => 'dashboard',
        };
    }
}
