<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBookings = Booking::count();

        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'totalBookings' => $totalBookings,
        ]);
    }
}
