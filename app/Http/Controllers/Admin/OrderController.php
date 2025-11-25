<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public $searchTerm = "";

    public function index(OrderItem $order_items, Request $request)
    {
        $role = Auth::user()->role_as;
    switch ($role) {
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

            return view('admin.orders.index', compact('order_items', 'ajuan_order_items', 'marikina_order_items', 'ortigas_order_items'));
            break;
    }

    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request, OrderItem $order_item)
    {
    $order = Order::create([
    'user_id' => auth()->user()->id
    ]);

    $request->validate([
        'location' => 'required',
        'site' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'checkoutdate' => 'required',
        'client' => 'required',
        'srnumber' => 'required',
        'ponumber' => 'required',
        'addmore.*.sku' => 'required',
        'addmore.*.quantity' => 'required',
        'addmore.*.serialnumber' => 'required',
    ]);


    foreach ($request->addmore as $key => $value) {
        $product = Product::whereRaw("LOWER(REPLACE(`location`, ' ' ,''))  = ?",  [strtolower (str_replace(' ', '', $request->location))])
         ->whereRaw("UPPER(REPLACE(`sku`, ' ' ,'')) = ?", [strtoupper(str_replace(' ', '', $value['sku']))])
        ->first();


        if ($product) {
            // check if the quantity requested is available in the inventory
            if ($value['quantity'] <= $product->quantity) {
                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->location = $request->location;
                $order_item->site = $request->site;
                $order_item->address = $request->address;
                $order_item->contact = $request->contact;
                $order_item->checkoutdate = $request->checkoutdate;
                $order_item->client = $request->client;
                $order_item->drnumber = $order->id + 1000;
                $order_item->srnumber = $request->srnumber;
                $order_item->ponumber = $request->ponumber;
                $order_item->sku = $value['sku'];
                $order_item->productcode = $product->productcode;
                $order_item->model = $product->model;
                $order_item->uom = $product->uom;
                $order_item->itemdescription = $product->description;
                $order_item->serialnumber = $value['serialnumber'];
                $order_item->quantity = $value['quantity'];
                $order_item->save();
            } else {
                return redirect('/admin/orders')->with('error', 'Invalid quantity! Not enough stock available.');
            }
        } else {
            return redirect('/admin/orders')->with('error', 'No item exists!');
        }
    }

    return redirect('/admin/orders' )->with('message', 'Stockout Created Successfully');

    }

    // PDF Generation
    public function ordersPDF()
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                $order_items = OrderItem::all();
                $pdf = PDF::loadView('admin.orders.ordersPDF', compact('order_items'))->setPaper('legal', 'landscape');
                return $pdf->download('Delivery-' . $todayDate . '.pdf');
                break;
        }
    }

    // Delete
    public function destroy($id)
    {
        $order_items = OrderItem::findOrFail($id);

        if ($order_items) {
            $order_items->delete();
            return redirect('/admin/orders')->with('warning', 'Checkout item deleted!');
        } else {
            return redirect('/admin/orders')->with('error', 'Can\'t delete non-existing item!');
        }
    }

    // Get Item ID for Editing
    public function edit(int $id)
    {
        $order_item = OrderItem::findOrFail($id);
        return view('admin.orders.edit', compact('order_item'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'site' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'checkoutdate' => 'required|after:01/01/2012',
            'client' => 'required',
            'drnumber' => 'required',
            'srnumber' => 'required',
            'ponumber' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);

        $nospaceprodcode = str_replace(' ', '', $request->productcode);
        $nospacesku = str_replace(' ', '', $request->sku);
        $nospacemodel = str_replace(' ', '', $request->model);
        $order_item = OrderItem::find($id);
        $order_item->site = $request->site;
        $order_item->address = $request->address;
        $order_item->contact = $request->contact;
        $order_item->checkoutdate = $request->checkoutdate;
        $order_item->client = $request->client;
        $order_item->drnumber = $request->drnumber;
        $order_item->srnumber = $request->srnumber;
        $order_item->ponumber = $request->ponumber;
        $order_item->itemdescription = $request->itemdescription;
        $order_item->serialnumber = $request->serialnumber;
        $order_item->save();

        return redirect('/admin/orders')->with('message', 'Checkout item updated successfully');
    }


    public function generateForm(Request $request, OrderItem $orderItem)
    {

        $validated = $request->input('drnumber');
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        if (OrderItem::query()->whereEquals('drnumber', $validated)->exists()) {

            $order_items = OrderItem::query()->whereEquals('drnumber', $validated)->get();
            $drnumber = $validated;
            $pdf = PDF::loadView('admin.orders.form', compact('order_items','drnumber'))->setPaper('A4', 'portrait');
            return $pdf->download('delivery-receipt_' . $todayDate . '.pdf');
        } else {
            return redirect('/admin/orders')->with('error', 'No DR record found!');
        }

    }
}
