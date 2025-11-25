<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use App\Models\Product;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class BorrowerController extends Controller
{

    public function index(Borrower $borrowers, Request $request)
    {
        if (!Auth::user()->role_as == '3') {
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } elseif (Auth::user()->role_as == '1') {
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } else {
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
            return view('manager.borrowers.index', compact('borrowers', 'marikina_borrowers', 'ajuan_borrowers', 'ortigas_borrowers'));
        }
    }


    public function create()
    {
        return view('manager.borrowers.create');
    }


    public function store(Request $request, Borrower $borrowers, Product $product)
    {

        $order = Order::create([
            'user_id' => auth()->user()->id
        ]);
        //DATA VALIDATION
        $request->validate([
            'location' => 'required',
            'site' => 'required',
            'address' => 'required',
            'checkoutdate' => 'required|after:01/01/2012',
            'client' => 'required',
            'dateofreturn' => 'required|after:checkoutdate',
            'addmore.*.sku' => 'required',
            'addmore.*.quantity' => 'required',
            'addmore.*.serialnumber' => 'required',

        ]);

        $stonumber = rand(1000, 9999);

        foreach ($request->addmore as $key => $value) {
            // check if product exists with matching location, model, sku, productcode, and uom
            $product = Product::whereRaw("LOWER(REPLACE(`location`, ' ' ,''))  = ?",  [strtolower(str_replace(' ', '', $request->location))])
                ->whereRaw("UPPER(REPLACE(`sku`, ' ' ,'')) = ?", [strtoupper(str_replace(' ', '', $value['sku']))])
                ->first();

            if ($product) {
                // check if the quantity requested is available in the inventory
                if ($value['quantity'] <= $product->quantity) {
                    $borrowers = new Borrower();
                    $borrowers->location = $request->location;
                    $borrowers->site = $request->location;
                    $borrowers->address = $request->location;
                    $borrowers->checkoutdate = $request->checkoutdate;
                    $borrowers->client = $request->client;
                    $borrowers->brnumber = $order->id + 1000;
                    $borrowers->dateofreturn = $request->dateofreturn;
                    $borrowers->sku = strtoupper(str_replace(' ', '', $value['sku']));
                    $borrowers->productcode = $product->productcode;
                    $borrowers->model = $product->model;
                    $borrowers->uom = $product->uom;
                    $borrowers->itemdescription = $product->description;
                    $borrowers->serialnumber = $value['serialnumber'];
                    $borrowers->quantity = $value['quantity'];
                    $borrowers->save();
                } else {
                    return redirect('/manager/borrowers')->with('error', 'Invalid quantity! Not enough stock available.');
                }
            } else {
                return redirect('/manager/borrowers')->with('error', 'No item exists!');
            }
        }

        return redirect('/manager/borrowers')->with('message', 'Borrowed Item Created Successfully!');
    }




    // PDF Generation
    public function borrowersPDF()
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
                $borrowers = Borrower::all();
                $pdf = PDF::loadView('manager.borrowers.borrowersPDF', compact('borrowers'))->setPaper('legal', 'landscape');
                return $pdf->download('Borrowed-Items-' . $todayDate . '.pdf');
                break;
        }
    }

    // Delete
    public function destroy($id)
    {
        $borrowers = Borrower::findOrFail($id);
        if ($borrowers) {
            $borrowers->delete();
            return redirect('/manager/borrowers')->with('warning', 'Borrowed item deleted!');
        } else {
            return redirect('/manager/borrowers')->with('error', 'Can\'t delete non-existing item!');
        }
    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $borrowers = Borrower::findOrFail($id);
        return view('manager.borrowers.edit', compact('borrowers'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'site' => 'required',
            'address' => 'required',
            'checkoutdate' => 'required|after:01/01/2012',
            'client' => 'required',
            'brnumber' => 'required',
            'dateofreturn' => 'required|after:checkoutdate',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);

        $borrowers = Borrower::find($id);
        $nospaceprodcode = str_replace(' ', '', $request->productcode);
        $nospacesku = str_replace(' ', '', $request->sku);
        $nospacemodel = str_replace(' ', '', $request->model);

        $borrowers->site = $request->site;
        $borrowers->address = $request->address;
        $borrowers->checkoutdate = $request->checkoutdate;
        $borrowers->client = $request->client;
        $borrowers->brnumber = $request->brnumber;
        $borrowers->dateofreturn = $request->dateofreturn;
        $borrowers->itemdescription = $request->itemdescription;
        $borrowers->serialnumber = $request->serialnumber;
        $borrowers->save();

        return redirect('/manager/borrowers')->with('message', 'Borrowed item updated successfully!');
    }



    public function generateForm(Request $request, Borrower $Borrower)
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        $validated = $request->input('brnumber');

        if (Borrower::query()->whereEquals('brnumber', $validated)->exists()) {

            $borrowers = Borrower::whereEquals('brnumber', $validated)->get();
            $brnumber = $validated;

            $pdf = PDF::loadView('manager.borrowers.form', compact('borrowers', 'brnumber'))->setPaper('A4', 'portrait');
            return $pdf->download('borrowers-slip-' . $todayDate . '.pdf');
        } else
            return redirect('/manager/borrowers')->with('error', 'No BR record found!');
    }
}
