<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\StudentProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentOnboardingController extends Controller
{
    public function create(): View
    {
        $interests = Interest::orderBy('name')->get();

        return view('onboarding.student', [
            'interests' => $interests,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'study_level' => ['required', 'string', 'max:255'],
            'situation' => ['required', Rule::in(['classic', 'cned', 'alternance', 'reprise', 'entrepreneur', 'other'])],
            'study_field' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'campus' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'visibility_students_only' => ['nullable', 'boolean'],
            'hide_from_public_groups' => ['nullable', 'boolean'],
            'hide_from_recommendations' => ['nullable', 'boolean'],
            'interests' => ['nullable', 'array'],
            'interests.*' => ['integer', 'exists:interests,id'],
        ]);

        $profileData = [
            'user_id' => $user->id,
            'study_level' => $validated['study_level'],
            'situation' => $validated['situation'],
            'study_field' => $validated['study_field'],
            'year' => $validated['year'],
            'city' => $validated['city'] ?? null,
            'campus' => $validated['campus'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'visibility_students_only' => $request->boolean('visibility_students_only', true),
            'hide_from_public_groups' => $request->boolean('hide_from_public_groups', false),
            'hide_from_recommendations' => $request->boolean('hide_from_recommendations', false),
        ];

        StudentProfile::updateOrCreate(['user_id' => $user->id], $profileData);

        $user->interests()->sync($validated['interests'] ?? []);

        return redirect()->route('dashboard.student');
    }
}
