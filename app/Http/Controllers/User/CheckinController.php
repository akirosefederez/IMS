<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Category;
use App\Models\Brand;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function index(Checkin $checkins, Request $request)
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
            $categories = Category::orderBy('name')->get();
            $brands = Brand::orderBy('name')->get();

            $checkinsQuery = Checkin::query();
            $marikinaQuery = Checkin::where('location', 'MARIKINA');
            $ajuanQuery = Checkin::where('location', 'A-JUAN');
            $ortigasQuery = Checkin::where('location', 'ORTIGAS');

            if ($request->has('term')) {
                $term = $request->term;


                $marikinaQuery->where(function ($query) use ($term) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('checkindate', 'LIKE', '%' . $term . '%')
                        ->orWhere('ponumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('strnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                        ->orWhere('brand', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });

                $ajuanQuery->where(function ($query) use ($term) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('checkindate', 'LIKE', '%' . $term . '%')
                        ->orWhere('ponumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('strnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                        ->orWhere('brand', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });

                $ortigasQuery->where(function ($query) use ($term) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('checkindate', 'LIKE', '%' . $term . '%')
                        ->orWhere('ponumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('strnumber', 'LIKE', '%' . $term . '%')
                        ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                        ->orWhere('brand', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%');
                });
            }

            $marikina_checkins = $marikinaQuery->paginate(20, ['*'],'marikina_checkins');
            $ajuan_checkins = $ajuanQuery->paginate(20, ['*'],'ajuan_checkins');
            $ortigas_checkins = $ortigasQuery->paginate(20, ['*'],'ortigas_checkins');
                return view('users.checkins.index', compact('checkins','categories','brands', 'marikina_checkins', 'ajuan_checkins', 'ortigas_checkins'));
                break;
        }

    } else {
        return view('auth.login');

      }


    }
    //GENERATE PDF FUNCTION
    public function checkinsPDF(){
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

                $checkins = Checkin::all();
                $pdf = PDF::loadView('users.checkins.checkinsPDF', compact('checkins'))->setPaper('legal','landscape');
                return $pdf->download('checkins_'.$todayDate.'.pdf');
                break;
        }

    }
}
