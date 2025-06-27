<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirect()
    {
        if (auth()->user()->isSuperAdmin()) {
            return redirect()->route('super_admin.dashboard');
        }

        if (auth()->user()->isManager()) {
            return redirect()->route('manager.dashboard');
        }

        return redirect()->route('participant.dashboard');
    }
}
