<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BorrowerController extends Controller
{

    public function index(Borrower $borrowers, Request $request)
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
            $marikinaQuery = Borrower::where('location', 'MARIKINA');
            $ajuanQuery = Borrower::where('location', 'A-JUAN');
            $ortigasQuery = Borrower::where('location', 'ORTIGAS');

            if ($request->has('term')) {
                $term = $request->term;


                $marikinaQuery->where(function ($query) use ($term) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('client', 'LIKE', '%' . $term . '%')
                        ->orWhere('brnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('dateofreturn', 'LIKE', '%' . $term . '%')
                        ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });

                $ajuanQuery->where(function ($query) use ($term) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('client', 'LIKE', '%' . $term . '%')
                        ->orWhere('brnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('dateofreturn', 'LIKE', '%' . $term . '%')
                        ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });

                $ortigasQuery->where(function ($query) use ($term) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('client', 'LIKE', '%' . $term . '%')
                        ->orWhere('brnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('dateofreturn', 'LIKE', '%' . $term . '%')
                        ->orWhere('serialnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });
            }

            $marikina_borrowers = $marikinaQuery->paginate(20, ['*'],'marikina_borrowers');
            $ajuan_borrowers = $ajuanQuery->paginate(20, ['*'],'ajuan_borrowers');
            $ortigas_borrowers = $ortigasQuery->paginate(20, ['*'],'ortigas_borrowers');
                return view('users.borrows.index', compact('borrowers', 'marikina_borrowers', 'ajuan_borrowers', 'ortigas_borrowers'));
                break;
        }

    } else {
        return view('auth.login');

      }



    }


    // PDF Generation
    public function borrowedItemsPDF()
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
                $borrowers = Borrower::all();
                $pdf = PDF::loadView('users.borrows.borroweditemsPDF', compact('borrowers'))->setPaper('legal', 'landscape');
                return $pdf->download('Borrowed-Items-'.$todayDate.'.pdf');
                break;
        }
    }
}
