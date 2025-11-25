<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Carbon;
use App\Exports\ExportInventory;
use Maatwebsite\Excel\Facades\Excel;
class ProductController extends Controller
{

    public function index(Request $request)
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
            $products = Product::where([
                [function ($query) use ($request) {
                    if (($term = $request->term)) {
                        $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%')
                        ->get();
                    }
                }]
            ])->paginate(10);
                return view('admin.products.index', compact('products'));
                break;
        }
    }

    public function inventoryPDF(){
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        $products = Product::all();
        $pdf = PDF::loadView('livewire.admin.products.inventoryPDF', compact('products'))->setPaper('legal', 'landscape');
        return $pdf->download('inventory-'.$todayDate.'.pdf');
    }

    public function checkAvailability(Product $products){
        $products = Product::all();
        Product::where('quantity', '>', 21)->update(['status' => 'Available']);
        Product::where('quantity', '<', 20)->update(['status' => 'Low Stock']);
        Product::where('quantity', '=', 0)->update(['status' => 'Out of Stock']);
        return view('admin.products.index', compact('products'));
     }

     public function export()
    {
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');

        return Excel::download(new ExportInventory, 'inventory-' .$todayDate. '.xlsx');
        return view('admin.products.index', compact('products'));

    }

}
