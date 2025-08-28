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

        if($user->role === 'staff'){
            $user->load(['staff.prodotti']);
        }

        return view('dashboard', [
            'user' => $user,
            'tecnico' => $user->tecnico ?? null,
            'centro'  => $user->tecnico->centro ?? null,
        ]);
    }
    
}
