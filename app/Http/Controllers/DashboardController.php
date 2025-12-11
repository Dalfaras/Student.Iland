<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        $role = Auth::user()->role;

        return match ($role) {
            'student' => redirect()->route('dashboard.student'),
            'association' => redirect()->route('dashboard.association'),
            'company' => redirect()->route('dashboard.company'),
            default => redirect('/'),
        };
    }

    public function student(): View
    {
        return view('dashboard.student');
    }

    public function association(): View
    {
        return view('dashboard.association');
    }

    public function company(): View
    {
        return view('dashboard.company');
    }
}
