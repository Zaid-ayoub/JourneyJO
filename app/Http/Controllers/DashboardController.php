<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $roleId = $user->role_id; // Fetch the role_id of the logged-in user

        // Check if the user is a super_admin (assuming role_id 3 is for super_admin)
        if ($roleId == 3) {
            // Fetch data for all companies (super_admin)
            
            // Total bookings, revenue, and customers for today and this year
            $salesToday = Booking::whereDate('created_at', Carbon::today())->count();
            $revenueToday = Booking::whereDate('created_at', Carbon::today())->sum('total_price');
            $customersThisYear = User::whereYear('created_at', Carbon::now()->year)->count();

            // For the report chart (last week data for all companies)
            $salesData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as sales'))
                ->whereDate('created_at', '>=', Carbon::now()->subWeek())
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('sales', 'date')->toArray();

            $revenueData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_price) as revenue'))
                ->whereDate('created_at', '>=', Carbon::now()->subWeek())
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('revenue', 'date')->toArray();

            $customersData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as customers'))
                ->whereDate('created_at', '>=', Carbon::now()->subWeek())
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('customers', 'date')->toArray();

            // Fetch recent activities (for all companies)
            $recentActivities = Booking::with('user', 'tour')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

        } else {
            // Fetch data for a specific company (company role, role_id 2)
            
            // Filter bookings, revenue, and customers by the company (using role_id)
            // Assuming you have a relation that links the user to the company or you can fetch bookings by the user's ID
            
            $salesToday = Booking::whereDate('created_at', Carbon::today())
                ->where('user_id', $user->id) // Assuming the user makes bookings, and the company ID is tied to the user
                ->count();
            $revenueToday = Booking::whereDate('created_at', Carbon::today())
                ->where('user_id', $user->id)
                ->sum('total_price');
            $customersThisYear = User::whereYear('created_at', Carbon::now()->year)
                ->where('role_id', 2) // Assuming the company users have role_id 2
                ->count();

            // For the report chart (last week data for the logged-in company)
            $salesData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as sales'))
                ->whereDate('created_at', '>=', Carbon::now()->subWeek())
                ->where('user_id', $user->id) // Filter by the logged-in user's company
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('sales', 'date')->toArray();

            $revenueData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_price) as revenue'))
                ->whereDate('created_at', '>=', Carbon::now()->subWeek())
                ->where('user_id', $user->id)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('revenue', 'date')->toArray();

            $customersData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as customers'))
                ->whereDate('created_at', '>=', Carbon::now()->subWeek())
                ->where('role_id', 2) // Assuming companies have role_id 2
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('customers', 'date')->toArray();

            // Fetch recent activities for the company (filter by the company users, assuming related to the user)
            $recentActivities = Booking::with('user', 'tour')
                ->where('user_id', $user->id) // Filter by company
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        // Pass the data to the view
        return view('admin_dashboard', compact(
            'salesToday',
            'revenueToday',
            'customersThisYear',
            'salesData',
            'revenueData',
            'customersData',
            'recentActivities'
        ));
    }
}