<?php

namespace App\Http\Controllers\User;

use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(OrderItem $order_items, Request $request)
    {
        if(Auth::check()){
        $role = Auth::user()->role_as;
        switch ($role) {
            case 1:
                return redirect()->back();
                break;

            case 3:
                return redirect()->back();
                break;

            default:
            $marikina_order_items = OrderItem::where('location', 'MARIKINA');

            $ajuan_order_items = OrderItem::where('location', 'A-JUAN');

            $ortigas_order_items = OrderItem::where('location', 'ORTIGAS');

            if ($request->has('term')) {
                $term = $request->term;
                $marikina_order_items->where(function ($query) use ($term) {
                    $query->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });

                $ajuan_order_items->where(function ($query) use ($term) {
                    $query->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });

                $ortigas_order_items->where(function ($query) use ($term) {
                    $query->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });
            }

            $marikina_order_items = $marikina_order_items->paginate(20, ['*'], 'marikina_order_items');
            $ajuan_order_items = $ajuan_order_items->paginate(20, ['*'], 'ajuan_order_items');
            $ortigas_order_items = $ortigas_order_items->paginate(20, ['*'], 'ortigas_order_items');
            return view('users.orders.index', compact('order_items', 'ajuan_order_items', 'marikina_order_items', 'ortigas_order_items'));
                break;
        }

    } else {
        return view('auth.login');

      }
    }

    // PDF Generation
    public function checkoutsPDF()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 1:
                return redirect()->back();
                break;

            case 3:
                return redirect()->back();
                break;

            default:
            $todayDate = Carbon::now()->format('d-m-Y H:i:s');

                $order_items = OrderItem::all();
                $pdf = PDF::loadView('users.orders.checkoutsPDF', compact('order_items'))->setPaper('legal', 'landscape');
                return $pdf->download('Delivery-'.$todayDate.'.pdf');
                break;
        }
    }
}
