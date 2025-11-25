<?php

namespace App\Http\Controllers\Admin;

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
        $role = Auth::user()->role_as;
        switch ($role) {
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

                return view('admin.borrowers.index', compact('borrowers', 'marikina_borrowers', 'ajuan_borrowers', 'ortigas_borrowers'));
                break;
        }
    }

    //SAVE DATA IN THE DATABASE
    public function store(Request $request, Borrower $borrowers, Product $product)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id
        ]);
        //VALIDATOR
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
        //QUERY TO CHECK IF THE PRODUCT EXISTS IN THE DATABASE
        foreach ($request->addmore as $key => $value) {
            $product = Product::whereRaw("LOWER(REPLACE(`location`, ' ' ,''))  = ?",  [strtolower (str_replace(' ', '', $request->location))])
            ->whereRaw("UPPER(REPLACE(`sku`, ' ' ,'')) = ?", [strtoupper(str_replace(' ', '', $value['sku']))])
            ->first();

            if ($product) {
                // check if the quantity requested is available in the inventory
                if ($value['quantity'] <= $product->quantity) {
                    $borrowers = new Borrower();
                    $borrowers->location = $request->location;
                    $borrowers->site = $request->site;
                    $borrowers->address = $request->address;
                    $borrowers->checkoutdate = $request->checkoutdate;
                    $borrowers->client = $request->client;
                    $borrowers->brnumber = $order->id + 1000;
                    $borrowers->dateofreturn = $request->dateofreturn;
                    $borrowers->sku = $value['sku'];
                    $borrowers->productcode = $product->productcode;
                    $borrowers->model = $product->model;
                    $borrowers->uom = $product->uom;
                    $borrowers->itemdescription = $product->description;
                    $borrowers->serialnumber = $value['serialnumber'];
                    $borrowers->quantity = $value['quantity'];
                    $borrowers->save();
                } else {
                    return redirect('/admin/borrowers')->with('error', 'Invalid quantity! Not enough stock available.');
                }
            } else {
                return redirect('/admin/borrowers')->with('error', 'No item exists!');
            }
        }

        return redirect('/admin/borrowers')->with('message', 'Item Borrow Created Successfully');
    }

    // PDF Generation
    public function borrowersPDF()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                $todayDate = Carbon::now()->format('d-m-Y H:i:s');
                $borrowers = Borrower::all();
                $pdf = PDF::loadView('admin.borrowers.borrowersPDF', compact('borrowers'))->setPaper('legal', 'landscape');
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
            return redirect('/admin/borrowers')->with('warning', 'Borrowed item deleted!');
        } else {
            return redirect('/admin/borrowers')->with('error', 'Can\'t delete non-existing item!');
        }
    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $borrowers = Borrower::findOrFail($id);
        return view('admin.borrowers.edit', compact('borrowers'));
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
        $borrowers->site = $request->site;
        $borrowers->address = $request->address;
        $borrowers->checkoutdate = $request->checkoutdate;
        $borrowers->client = $request->client;
        $borrowers->brnumber = $request->brnumber;
        $borrowers->dateofreturn = $request->dateofreturn;
        $borrowers->itemdescription = $request->itemdescription;
        $borrowers->serialnumber = $request->serialnumber;
        $borrowers->save();

        return redirect('/admin/borrowers')->with('message', 'Borrowed item updated successfully!');
    }

    //GENERATE THE FORM USING BR NUMBER
    public function generateForm(Request $request, Borrower $Borrower)
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');
        $validated = $request->input('brnumber');
        if (Borrower::query()->whereEquals('brnumber', $validated)->exists()) {
            $borrowers = Borrower::whereEquals('brnumber', $validated)->get();
            $brnumber = $validated;
            $pdf = PDF::loadView('admin.borrowers.form', compact('borrowers', 'brnumber'))->setPaper('A4', 'portrait');
            return $pdf->download('borrowers-slip-' . $todayDate . '.pdf');
        } else
            return redirect('/admin/borrowers')->with('error', 'No BR record found!');
    }
}
