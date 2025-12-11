<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use App\Models\Association;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssociationOnboardingController extends Controller
{
    public function create(): View
    {
        return view('onboarding.association');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'campus' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Association::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'name' => $validated['name'],
                'campus' => $validated['campus'] ?? null,
                'description' => $validated['description'] ?? null,
            ]
        );

        return redirect()->route('dashboard.association');
    }
}
