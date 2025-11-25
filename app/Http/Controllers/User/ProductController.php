<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
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
                $categories = Category::all();
                $brands = Brand::all();

                $marikina_products = Product::where('location', 'MARIKINA');

                $ajuan_products = Product::where('location', 'A-JUAN');

                $ortigas_products = Product::where('location', 'ORTIGAS');


                // Apply search term to all product queries
                if ($request->has('term')) {
                    $term = $request->term;
                    $ajuan_products->where(function ($query) use ($term) {
                        $query->orWhere('location', 'LIKE', '%' . $term . '%')
                            ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                            ->orWhere('brand', 'LIKE', '%' . $term . '%')
                            ->orWhere('model', 'LIKE', '%' . $term . '%')
                            ->orWhere('sku', 'LIKE', '%' . $term . '%')
                            ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                            ->orWhere('uom', 'LIKE', '%' . $term . '%');
                    });

                        $marikina_products->where(function ($query) use ($term) {
                            $query->orWhere('location', 'LIKE', '%' . $term . '%')
                                ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                                ->orWhere('brand', 'LIKE', '%' . $term . '%')
                                ->orWhere('model', 'LIKE', '%' . $term . '%')
                                ->orWhere('sku', 'LIKE', '%' . $term . '%')
                                ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                                ->orWhere('uom', 'LIKE', '%' . $term . '%');
                        });


                        $ortigas_products->where(function ($query) use ($term) {
                            $query->orWhere('location', 'LIKE', '%' . $term . '%')
                                ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                                ->orWhere('brand', 'LIKE', '%' . $term . '%')
                                ->orWhere('model', 'LIKE', '%' . $term . '%')
                                ->orWhere('sku', 'LIKE', '%' . $term . '%')
                                ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                                ->orWhere('uom', 'LIKE', '%' . $term . '%');
                        });
                }

                $marikina_products = $marikina_products->paginate(20, ['*'], 'marikina_products');
                $ajuan_products = $ajuan_products->paginate(20, ['*'], 'ajuan_products');
                $ortigas_products = $ortigas_products->paginate(20, ['*'], 'ortigas_products');

                return view('users.products.index', compact('categories', 'brands', 'ajuan_products', 'marikina_products', 'ortigas_products'));
                break;
        }
    } else {
        return view('auth.login');

      }

    }


    public function inventoryPDF()
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

                $products = Product::all();
                $pdf = PDF::loadView('users.products.inventoryPDF', compact('products'))->setPaper('legal', 'landscape');
                return $pdf->download('inventory-' . $todayDate . '.pdf');
                break;
        }
    }
}
