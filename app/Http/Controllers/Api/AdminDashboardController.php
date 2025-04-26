<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Your admin dashboard logic here
        return response()->json([
            'message' => 'Welcome to the admin dashboard!',
        ]);
    }
}
