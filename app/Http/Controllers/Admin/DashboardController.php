<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Function to show users listing
     */
    public function index(Request $request) {
        $users = User::with('user_information')->paginate(14);

        return View::make('dashboard')->with(compact('users'));
    }
}
