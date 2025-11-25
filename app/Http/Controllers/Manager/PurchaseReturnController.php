<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseReturn;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PurchaseReturnController extends Controller
{


    public function index(PurchaseReturn $purchase_returns, Request $request)
    {
        if (!Auth::user()->role_as == '3') {
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } elseif (Auth::user()->role_as == '1') {
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } else {
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
            return view('manager.purchasereturns.index', compact('purchase_returns', 'ajuan_purchase_returns', 'marikina_purchase_returns', 'ortigas_purchase_returns'));
        }
    }


    public function create()
    {
        return view('manager.purchasereturns.create');
    }

    public function store(Request $request, PurchaseReturn $purchase_returns, Product $product)
    {

        $order = Order::create([
            'user_id' => auth()->user()->id
        ]);

        $request->validate([
            'location' => 'required',
            'site' => 'required',
            'address' => 'required',
            'checkoutdate' => 'required|after:01/01/2012',
            'client' => 'required',
            'prsnumber' => 'required',
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
                    $purchase_returns = new PurchaseReturn();
                    $purchase_returns->location = $request->location;
                    $purchase_returns->site = $request->site;
                    $purchase_returns->address = $request->address;
                    $purchase_returns->checkoutdate = $request->checkoutdate;
                    $purchase_returns->client = $request->client;
                    $purchase_returns->drnumber = $order->id + 1000;
                    $purchase_returns->prsnumber = $request->prsnumber;
                    $purchase_returns->sku = strtoupper(str_replace(' ', '', $value['sku']));
                    $purchase_returns->productcode = $product->productcode;
                    $purchase_returns->model = $product->model;
                    $purchase_returns->uom = $product->uom;
                    $purchase_returns->itemdescription = $product->description;
                    $purchase_returns->serialnumber = $value['serialnumber'];
                    $purchase_returns->quantity = $value['quantity'];
                    $purchase_returns->save();
                } else {
                    return redirect('/manager/purchasereturns')->with('error', 'Invalid quantity! Not enough stock available.');
                }
            } else {
                return redirect('/manager/purchasereturns')->with('error', 'No item exists!');
            }
        }

        return redirect('/manager/purchasereturns')->with('message', 'Purchase Return Created Successfully');
    }

    // PDF Generation
    public function purchasereturnsPDF()
    {

        $role = Auth::user()->role_as;
        switch ($role) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->back();
                break;

            default:
                $todayDate = Carbon::now()->format('d-m-Y H:i:s');

                $purchase_returns = PurchaseReturn::all();
                $pdf = PDF::loadView('manager.purchasereturns.purchasereturnsPDF', compact('purchase_returns'))->setPaper('legal', 'landscape');
                return $pdf->download('purchasereturns_' . $todayDate . '.pdf');
                break;
        }
    }

    // Delete
    public function destroy($id)
    {
        $purchase_returns = PurchaseReturn::findOrFail($id);
        if ($purchase_returns) {
            $purchase_returns->delete();
            return redirect('/manager/purchasereturns')->with('warning', 'Purchase return item deleted!');
        } else {
            return redirect('/manager/purchasereturns')->with('error', 'Can\'t delete non-existing item!');
        }
    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $purchase_returns = PurchaseReturn::findOrFail($id);
        return view('manager.purchasereturns.edit', compact('purchase_returns'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'site' => 'required',
            'address' => 'required',
            'checkoutdate' => 'required|after:01/01/2012',
            'client' => 'required',
            'drnumber' => 'required',
            'prsnumber' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);


        $nospaceprodcode = str_replace(' ', '', $request->productcode);
        $nospacesku = str_replace(' ', '', $request->sku);
        $nospacemodel = str_replace(' ', '', $request->model);

        $purchase_returns = PurchaseReturn::find($id);
        $purchase_returns->site = $request->site;
        $purchase_returns->address = $request->address;
        $purchase_returns->checkoutdate = $request->checkoutdate;
        $purchase_returns->client = $request->client;
        $purchase_returns->drnumber = $request->drnumber;
        $purchase_returns->prsnumber = $request->prsnumber;
        $purchase_returns->itemdescription = $request->itemdescription;
        $purchase_returns->serialnumber = $request->serialnumber;

        $purchase_returns->save();

        return redirect('/manager/purchasereturns')->with('message', 'Purchase return item updated successfully');
    }


    public function generateForm(Request $request, PurchaseReturn $PurchaseReturn)
    {
        $validated = $request->input('drnumber');
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        if (PurchaseReturn::query()->whereEquals('drnumber', $validated)->exists()) {

            $purchase_returns = PurchaseReturn::query()->whereEquals('drnumber', $validated)->get();
            $drnumber = $validated;

            $pdf = PDF::loadView('manager.purchasereturns.form', compact('purchase_returns', 'drnumber'))->setPaper('A4', 'portrait');
            return $pdf->download('purchasereturns-' . $todayDate . '.pdf');
        } else
            return redirect('/manager/purchasereturns')->with('error', 'No DR record found!');
    }
}
