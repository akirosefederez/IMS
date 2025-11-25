<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\ReturnSlip;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReturnSlipController extends Controller
{

    public function index(ReturnSlip $return_slips, Request $request)
    {
        $role = Auth::user()->role_as;
        switch ($role) {
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


                return view('admin.returns.index', compact('return_slips','ajuan_return_slips','marikina_return_slips', 'ortigas_return_slips'));
                break;
        }

    }

    public function store(Request $request, ReturnSlip $return_slips, Product $product)
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
            'rsnumber' => 'required',
            'addmore.*.sku' => 'required',
            'addmore.*.quantity' => 'required',
            'addmore.*.serialnumber' => 'required',

        ]);

        $stonumber = rand(1000, 9999);

        foreach ($request->addmore as $key => $value) {
            // check if product exists with matching location, model, sku, productcode, and uom
            $product = Product::whereRaw("LOWER(REPLACE(`location`, ' ' ,''))  = ?",  [strtolower (str_replace(' ', '', $request->location))])
            ->whereRaw("UPPER(REPLACE(`sku`, ' ' ,'')) = ?", [strtoupper(str_replace(' ', '', $value['sku']))])
            ->first();

            if ($product) {
                // check if the quantity requested is available in the inventory
                if ($value['quantity'] <= $product->quantity) {
                    $return_slips = new ReturnSlip();
                    $return_slips->location = $request->location;
                    $return_slips->site = $request->site;
                    $return_slips->address = $request->address;
                    $return_slips->checkoutdate = $request->checkoutdate;
                    $return_slips->client = $request->client;
                    $return_slips->drnumber = $order->id + 1000;
                    $return_slips->rsnumber = $request->rsnumber;
                    $return_slips->sku = $value['sku'];
                    $return_slips->productcode = $product->productcode;
                    $return_slips->model = $product->model;
                    $return_slips->uom = $product->uom;
                    $return_slips->itemdescription = $product->description;
                    $return_slips->serialnumber = $value['serialnumber'];
                    $return_slips->quantity = $value['quantity'];
                    $return_slips->save();
                } else {
                    return redirect('/admin/returns')->with('error', 'Invalid quantity! Not enough stock available.');
                }
            } else {
                return redirect('/admin/returns')->with('error', 'No item exists!');
            }
        }

        return redirect('/admin/returns')->with('message', 'Item Return Created Successfully');
    }

    // PDF Generation
    public function returnsPDF()
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        $return_slips = ReturnSlip::all();
        $pdf = PDF::loadView('admin.returns.returnsPDF', compact('return_slips'))->setPaper('legal', 'landscape');
        return $pdf->download('returns-'.$todayDate.'.pdf');
    }

    // Delete
    public function destroy($id)
    {
        $return_slips = ReturnSlip::findOrFail($id);
        if($return_slips){
            $return_slips->delete();
            return redirect('/admin/returns')->with('warning', 'Item return deleted!');
        } else {
            return redirect('/admin/returns')->with('error', 'Can\'t delete non-existing item!');
        }

    }

    // Get Item ID for Editing
    public function edit(int $id)
    {
        $return_slip = ReturnSlip::findOrFail($id);
        return view('admin.returns.edit', compact('return_slip'));
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
            'rsnumber' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);

        $return_slip = ReturnSlip::find($id);
        $return_slip->site = $request->site;
        $return_slip->address = $request->address;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->drnumber = $request->drnumber;
        $return_slip->rsnumber = $request->rsnumber;
        $return_slip->itemdescription = $request->itemdescription;
        $return_slip->serialnumber = $request->serialnumber;
        $return_slip->save();

        return redirect('/admin/returns')->with('message', 'Item return updated successfully');
    }


    public function generateForm(Request $request, ReturnSlip $ReturnSlip)
    {
        $validated = $request->input('drnumber');
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        if (ReturnSlip::query()->whereEquals('drnumber', $validated)->exists()) {

            $return_slips = ReturnSlip::query()->whereEquals('drnumber', $validated)->get();
            $drnumber = $validated;

            $pdf = PDF::loadView('admin.returns.form', compact('return_slips','drnumber'))->setPaper('A4', 'portrait');
            return $pdf->download('returnslip-'.$todayDate.'.pdf');
        } else
            return redirect('/admin/returns')->with('error', 'No DR record found!');
    }
}
