<?php

namespace App\Http\Controllers\User;

use App\Models\ReturnSlip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReturnSlipController extends Controller
{

    public function index(ReturnSlip $return_slips, Request $request)
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
            $marikina_return_slips = ReturnSlip::where('location', 'MARIKINA');

            $ajuan_return_slips = ReturnSlip::where('location', 'A-JUAN');

            $ortigas_return_slips = ReturnSlip::where('location', 'ORTIGAS');

            if ($request->has('term')) {
                $term = $request->term;
                $marikina_return_slips->where(function ($query) use ($term) {
                    $query->orWhere('checkoutdate', 'LIKE', '%' . $term . '%')
                    ->orWhere('client', 'LIKE', '%' . $term . '%')
                    ->orWhere('drnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('rsnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('model', 'LIKE', '%' . $term . '%')
                    ->orWhere('sku', 'LIKE', '%' . $term . '%')
                    ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                    ->orWhere('uom', 'LIKE', '%' . $term . '%')
                    ->orWhere('itemdescription', 'LIKE', '%' . $term . '%');
                });

                $ajuan_return_slips->where(function ($query) use ($term) {
                    $query->orWhere('checkoutdate', 'LIKE', '%' . $term . '%')
                    ->orWhere('client', 'LIKE', '%' . $term . '%')
                    ->orWhere('drnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('rsnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('model', 'LIKE', '%' . $term . '%')
                    ->orWhere('sku', 'LIKE', '%' . $term . '%')
                    ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                    ->orWhere('uom', 'LIKE', '%' . $term . '%')
                    ->orWhere('itemdescription', 'LIKE', '%' . $term . '%');
                });

                $ortigas_return_slips->where(function ($query) use ($term) {
                    $query->orWhere('checkoutdate', 'LIKE', '%' . $term . '%')
                    ->orWhere('client', 'LIKE', '%' . $term . '%')
                    ->orWhere('drnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('rsnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                    ->orWhere('model', 'LIKE', '%' . $term . '%')
                    ->orWhere('sku', 'LIKE', '%' . $term . '%')
                    ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                    ->orWhere('uom', 'LIKE', '%' . $term . '%')
                    ->orWhere('itemdescription', 'LIKE', '%' . $term . '%');
                });
            }

            $marikina_return_slips = $marikina_return_slips->paginate(5, ['*'], 'marikina_return_slips');
            $ajuan_return_slips = $ajuan_return_slips->paginate(5, ['*'], 'ajuan_return_slips');
            $ortigas_return_slips = $ortigas_return_slips->paginate(5, ['*'], 'ortigas_return_slips');
                return view('users.returns.index', compact('return_slips','ajuan_return_slips','marikina_return_slips', 'ortigas_return_slips'));
                break;
        }

    } else {
        return view('auth.login');

      }

    }

    // PDF Generation
    public function returnsPDF()
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

                $return_slips = ReturnSlip::all();
                $pdf = PDF::loadView('users.returns.returnsPDF', compact('return_slips'))->setPaper('legal', 'landscape');
                return $pdf->download('returns_'.$todayDate.'.pdf');
                break;
        }
    }
}
