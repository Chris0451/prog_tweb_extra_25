<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'tecnico') {
            $user->load(['tecnico.centro']);
        }

        return view('layouts.users_layouts.dashboard', [
            'user' => $user,
            'tecnico' => $user->tecnico ?? null,
            'centro'  => $user->tecnico->centro ?? null,
        ]);
    }
}
