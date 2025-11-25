<?php

namespace App\Http\Livewire\Manager\Products;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id, $location, $brand, $model, $sku, $description, $quantity, $productcode, $uom, $status, $category_name, $currentStatus;


    public $activeTab;

    public function mount()
    {
        $this->activeTab = session('activeTab', 'ajuan');
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        session(['activeTab' => $this->activeTab]);
    }
    public function render(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::where('category_id', $this->category_id)->orderBy('name')->get();

        $marikina_products = Product::where('location', 'MARIKINA')
            ->where(function ($query) use ($request) {
                $this->applySearchFilters($query, $request);
            })->paginate(20, ['*'], 'marikina_products_page');

        $ajuan_products = Product::where('location', 'A-JUAN')
            ->where(function ($query) use ($request) {
                $this->applySearchFilters($query, $request);
            })->paginate(20, ['*'], 'ajuan_products_page');

        $ortigas_products = Product::where('location', 'ORTIGAS')
            ->where(function ($query) use ($request) {
                $this->applySearchFilters($query, $request);
            })->paginate(20, ['*'], 'ortigas_products_page');
        return view('livewire.manager.products.index', [
            'categories' => $categories,
            'brands' => $brands,
            'marikina_products' => $marikina_products,
            'ajuan_products' => $ajuan_products,
            'ortigas_products' => $ortigas_products,
        ]);
    }

    private function applySearchFilters($query, $request)
    {
        if ($term = $request->term) {
            $query->where('location', 'LIKE', '%' . $term . '%')
                ->orWhere('category_id', 'LIKE', '%' . $term . '%')
                ->orWhere('brand', 'LIKE', '%' . $term . '%')
                ->orWhere('model', 'LIKE', '%' . $term . '%')
                ->orWhere('sku', 'LIKE', '%' . $term . '%')
                ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                ->orWhere('uom', 'LIKE', '%' . $term . '%');
        }
    }


    public function inventoryPDF()
    {
        $products = Product::all();
        $pdf = PDF::loadView('livewire.manager.products.inventoryPDF', compact('products'))->setPaper('legal', 'landscape');
        return $pdf->download('Inventory.pdf');
    }

    // validation
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'location' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'sku' => 'required|string',
            'productcode' => 'required|string',
            'uom' => 'required|string',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'status' => 'sometimes:required|integer',

        ];
    }

    //reset input fields
    public function resetInput()
    {
        $this->location = NULL;
        $this->brand = NULL;
        $this->model = NULL;
        $this->sku = NULL;
        $this->productcode = NULL;
        $this->uom = NULL;
        $this->description = NULL;
        $this->quantity = NULL;
        $this->status = NULL;
        $this->category_id = NULL;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    //store function
    public function storeInventory()
    {

        Product::create([
            'category_id' => $this->category_id,
            'location' => $this->location,
            'brand' => $this->brand,
            'model' => $this->model,
            'sku' => $this->sku,
            'productcode' => $this->productcode,
            'uom' => $this->uom,
            'description' => $this->description,
            'quantity' => $this->quantity,
        ]);
        session()->flash('message', 'Item added successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    //fetch product ID for deletion
    public function deleteProduct($product_id)
    {
        $this->product_id = $product_id;
    }

    //delete function
    public function destroyProduct()
    {
        try {
            Product::findOrFail($this->product_id)->delete();
            session()->flash('warning', 'Item deleted successfully!');
            $this->dispatchBrowserEvent('close-modal');
            $this->resetInput();
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                // return error to user here
                session()->flash('error', 'Cannot delete product!');
                $this->dispatchBrowserEvent('close-modal');
                $this->resetInput();
            }
        }
    }

    //fetch data for edit function
    public function editProduct(int $product_id)
    {

        $this->product_id = $product_id;
        $product = Product::findOrFail($product_id);
        $this->category_id = $product->category_id;
        $this->location = $product->location;
        $this->model = $product->model;
        $this->sku = $product->sku;
        $this->productcode = $product->productcode;
        $this->uom = $product->uom;
        $this->brand = $product->brand;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
    }

    //update function
    public function updateProduct()
    {
        $nospaceprodcode = str_replace(' ', '', $this->productcode);
        $nospacesku = str_replace(' ', '', $this->sku);
        $nospacemodel = str_replace(' ', '', $this->model);
        Product::findOrFail($this->product_id)->update([
            'category_id' => $this->category_id,
            'location' => $this->location,
            'brand' => $this->brand,
            'model' => $this->model,
            'sku' => $this->sku,
            'productcode' => $this->productcode,
            'uom' => $this->uom,
            'description' => $this->description,
            'quantity' => $this->quantity,
        ]);
        session()->flash('message', 'Item updated successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
}
