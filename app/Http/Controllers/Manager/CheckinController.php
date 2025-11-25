<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkin;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Carbon;


class CheckinController extends Controller
{


    public function index(Checkin $checkins, Request $request)
    {
        if (!Auth::user()->role_as == '3') {
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } elseif (Auth::user()->role_as == '1') {
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } else {
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
            return view('manager.checkin.index', compact('checkins', 'categories', 'brands', 'marikina_checkins', 'ajuan_checkins', 'ortigas_checkins'));
        }
    }


    public function create(Category $categories, Brand $brands)
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        return view('manager.checkin.create', compact('categories', 'brands'));
    }

    public function edit(int $id)
    {

        $checkin = Checkin::findOrFail($id);
        return view('manager.checkin.edit', compact('checkin'));
    }

    public function store(Request $request, Product $product)
    {

        $request->validate([
            'location' => 'required',
            'checkindate' => 'required|after:01/01/2012',
            'ponumber' => 'required',
            'strnumber' => 'required',
            'sku' => 'required',
            'serialnumber' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'remarks' => 'required',

        ]);

       $product = Product::whereRaw("LOWER(REPLACE(`location`, ' ' ,''))  = ?",  [strtolower(str_replace(' ', '', $request->location))])
            ->whereRaw("LOWER(REPLACE(`sku`, ' ' ,''))  = ?",  [strtolower(str_replace(' ', '', $request->sku))])
            ->first();
        if ($product) {
            if ($request->quantity >= 1) {
        $checkin = new Checkin();
        $checkin->location = $request->location;
        $checkin->checkindate = $request->checkindate;
        $checkin->category_id = $product->category_id;
        $checkin->ponumber = $request->ponumber;
        $checkin->strnumber = $request->strnumber;
        $checkin->brand = $product->brand;
        $checkin->productcode = $product->productcode;
        $checkin->sku = $product->sku;
        $checkin->model = $product->model;
        $checkin->itemdescription = $product->description;
        $checkin->serialnumber = $request->serialnumber;
        $checkin->quantity = $request->quantity;
        $checkin->uom = $product->uom;
        $checkin->status = $request->status;
        $checkin->remarks = $request->remarks;
        $checkin->save();
        return redirect('/manager/checkins')->with('message', 'Item Checked-in!');
            } else {
                return redirect('/manager/checkins')->with('error', 'Invalid quantity!');
            }
        } else {
            return redirect('/manager/checkins')->with('error', 'No item exists! Please check the item information.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'checkindate' => 'required|after:01/01/2012',
            'ponumber' => 'required',
            'strnumber' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
            'status' => 'required',
            'remarks' => 'required',

        ], []);

        $checkin = Checkin::find($id);

        $nospaceprodcode = str_replace(' ', '', $request->productcode);
        $nospacesku = str_replace(' ', '', $request->sku);
        $nospacemodel = str_replace(' ', '', $request->model);

        $checkin->checkindate = $request->checkindate;
        $checkin->ponumber = $request->ponumber;
        $checkin->strnumber = $request->strnumber;
        $checkin->itemdescription = $request->itemdescription;
        $checkin->serialnumber = $request->serialnumber;
        $checkin->status = $request->status;
        $checkin->remarks = $request->remarks;

        $checkin->save();

        return redirect('/manager/checkins')->with('message', 'Item updated!');
    }

    public function destroy($id)
    {

        $checkin = Checkin::findOrFail($id);

        if ($checkin) {
            $checkin->delete();
            return redirect('/manager/checkins')->with('warning', 'Check-in item deleted!');
        } else {
            return redirect('/manager/checkins')->with('error', 'Can\'t delete non-existing item!');
        }
    }


    public function checkinsPDF()
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        $role = Auth::user()->role_as;
        switch ($role) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->back();
                break;

            default:
                $checkins = Checkin::all();
                $pdf = PDF::loadView('manager.checkin.checkinsPDF', compact('checkins'))->setPaper('legal', 'landscape');
                return $pdf->download('checkins-' . $todayDate . '.pdf');
                break;
        }
    }
}
