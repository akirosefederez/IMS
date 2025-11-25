<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Checkin;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function lineChart(){

        if(Auth::check()){
            $role = Auth::user()->role_as;

       
            switch ($role) {
                case 3:
                    return redirect()->back();
                    break;
    
                default:
                    $checkins = Checkin::select('status', \DB::raw("COUNT('id') as count"))->groupBy('status')->get();
                    $order_items = OrderItem::select('location', \DB::raw("COUNT('id') as count"))->groupBy('location')->get();
                    $products = Product::select('brand', \DB::raw("COUNT('id') as count"))->groupBy('brand')->pluck('count');
                    $users = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
                    return view('home', compact('users', 'checkins', 'order_items', 'products'));
                    break;
            }
    
        } else {
          return view('auth.login');

        }
       
    }
}
