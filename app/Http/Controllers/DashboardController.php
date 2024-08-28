<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return inertia('Dashboard', [
            'user' => UserData::from(Auth::user())
        ]);
    }
}
