<?php

namespace App\Http\Controllers\User;

use App\Models\PurchaseReturn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurchaseReturnController extends Controller
{
    public function index(PurchaseReturn $purchase_returns, Request $request)
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
            $marikinaQuery = PurchaseReturn::where('location', 'MARIKINA');
                $ajuanQuery = PurchaseReturn::where('location', 'A-JUAN');
                $ortigasQuery = PurchaseReturn::where('location', 'ORTIGAS');

                if ($request->has('term')) {
                    $term = $request->term;

                    $marikinaQuery->where(function ($query) use ($term) {
                        $query->orWhere('location', 'LIKE', '%' . $term . '%')
                            ->orWhere('checkoutdate', 'LIKE', '%' . $term . '%')
                            ->orWhere('client', 'LIKE', '%' . $term . '%')
                            ->orWhere('drnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('prsnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('model', 'LIKE', '%' . $term . '%')
                            ->orWhere('sku', 'LIKE', '%' . $term . '%')
                            ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                            ->orWhere('uom', 'LIKE', '%' . $term . '%');
                    });

                    $ajuanQuery->where(function ($query) use ($term) {
                        $query->orWhere('location', 'LIKE', '%' . $term . '%')
                            ->orWhere('checkoutdate', 'LIKE', '%' . $term . '%')
                            ->orWhere('client', 'LIKE', '%' . $term . '%')
                            ->orWhere('drnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('prsnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('model', 'LIKE', '%' . $term . '%')
                            ->orWhere('sku', 'LIKE', '%' . $term . '%')
                            ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                            ->orWhere('uom', 'LIKE', '%' . $term . '%');
                    });

                    $ortigasQuery->where(function ($query) use ($term) {
                        $query->orWhere('location', 'LIKE', '%' . $term . '%')
                            ->orWhere('checkoutdate', 'LIKE', '%' . $term . '%')
                            ->orWhere('client', 'LIKE', '%' . $term . '%')
                            ->orWhere('drnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('prsnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                            ->orWhere('model', 'LIKE', '%' . $term . '%')
                            ->orWhere('sku', 'LIKE', '%' . $term . '%')
                            ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                            ->orWhere('uom', 'LIKE', '%' . $term . '%');
                    });
                }

                $ajuan_purchase_returns = $ajuanQuery->paginate(20 ,['*'], 'ajuan_purchase_returns');
                $marikina_purchase_returns = $marikinaQuery->paginate(20 ,['*'], 'marikina_purchase_returns');
                $ortigas_purchase_returns = $ortigasQuery->paginate(20 ,['*'], 'ortigas_purchase_returns');
                return view('users.purchasereturns.index', compact('purchase_returns', 'ajuan_purchase_returns', 'marikina_purchase_returns', 'ortigas_purchase_returns'));
                break;
        }
    } else {
        return view('auth.login');

      }
    }

    // PDF Generation
    public function purchasereturnsPDF()
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        $role = Auth::user()->role_as;
        switch ($role) {
            case 1:
                return redirect()->back();
                break;

            case 3:
                return redirect()->back();
                break;

            default:
                $purchase_returns = PurchaseReturn::all();
                $pdf = PDF::loadView('users.purchasereturns.purchasereturnsPDF', compact('purchase_returns'))->setPaper('legal', 'landscape');
                return $pdf->download('purchase-returns_'.$todayDate.'.pdf');
                break;
        }
    }
}
