@extends('layouts.app')
@section('title', 'Inventory')
@section('content')

    <div class="card mx-5">
        <div class="card-header">
            <h3>Inventory
                <a href="{{ url('/products/productsPDF') }}" class="btn btn-sm  float-right"
                    style="color:white; background-color: rgb(196, 80, 80);" title="Export table to PDF">
                    Export to PDF
                </a>
            </h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('product.search') }}" method="GET" role="search">
                    <div class="form-row float-right mb-2 mr-1">
                        <div class="input-group" style="max-width:18rem;">
                            <div class="input-group-prepend">
                                <button class="btn btn-primary" type="submit" title="Search Products" id="button-addon1"><i
                                        class="fas fa-search"></i></button>
                            </div>
                            <input type="text" class="form-control" placeholder="Search Products" name="term"
                                id="term" aria-label="Search field" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <a class="btn btn-danger" type="button" title="Refresh page"
                                    href="{{ url('/products') }}"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link{{ Request::get('tab') === 'ajuan' ? 'show active' : '' }}" id="ajuan-tab" data-toggle="tab" data-target="#ajuan" type="button" role="tab" aria-controls="ajuan" aria-selected="{{ Request::get('tab') === 'ajuan' ? 'true' : 'false' }}" wire:ignore>A-JUAN</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link{{ Request::get('tab') === 'marikina' ? 'show active' : '' }}"  id="marikina-tab" data-toggle="tab" data-target="#marikina" type="button" role="tab" aria-controls="marikina" aria-selected="{{ Request::get('tab') === 'marikina' ? 'true' : 'false' }}" wire:ignore>MARIKINA</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link{{ Request::get('tab') === 'ortigas' ? 'show active' : '' }}" id="ortigas-tab" data-toggle="tab" data-target="#ortigas" type="button" role="tab" aria-controls="ortigas" aria-selected="{{ Request::get('tab') === 'ortigas' ? 'true' : 'false' }}" wire:ignore>ORTIGAS</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    {{-- A JUAN TAB --}}
                    <div class="tab-pane fade {{ Request::get('tab') === 'ajuan' ? 'show active' : '' }}" id="ajuan"
                        role="tabpanel" aria-labelledby="ajuan-tab" wire:ignore.self>
                        <div class="table-responsive mb-3">
                            <table class="table table-striped table-bordered table-hover table-sm">
                                <thead class="table-dark">
                                    <tr class="text-nowrap">
                                        <th class="text-center align-middle">ID</th>
                                        <th class="text-center align-middle">Location</th>
                                        <th class="text-center align-middle">Category</th>
                                        <th class="text-center align-middle">Brand</th>
                                        <th class="text-center align-middle">Model</th>
                                        <th class="text-center align-middle">SKU</th>
                                        <th class="text-center align-middle">Product Code</th>
                                        <th class="text-center align-middle">UOM</th>
                                        <th class="text-center align-middle">Description</th>
                                        <th class="text-center align-middle">Quantity</th>
                                        <th class="text-center align-middle">Status</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ajuan_products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td class="text-nowrap">{{ $product->location }}</td>
                                            <td class="text-nowrap">
                                                @if ($product->category)
                                                    {{ $product->category->name }}
                                                @else
                                                    No Category
                                                @endif
                                            </td>
                                            <td class="text-nowrap">{{ $product->brand }}</td>
                                            <td class="text-nowrap">{{ $product->model }}</td>
                                            <td class="text-nowrap">{{ $product->sku }}</td>
                                            <td class="text-nowrap">{{ $product->productcode }}</td>
                                            <td class="text-nowrap">{{ $product->uom }}</td>
                                            <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">
                                                {{ $product->description }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                @if ($product->quantity === 0)
                                                    <label class="badge badge-danger"
                                                        title="This item is almost out of stock">Out of
                                                        Stock</label>
                                                @elseif($product->quantity < 20)
                                                    <label class="badge rounded btn-warning"
                                                        title="This item is unavailable">Low
                                                        Stock</label>
                                                @else
                                                    <label class="badge rounded btn-success"
                                                        title="This item is available">Available</label>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#viewProductModal-{{ $product->id }}"
                                                    class="btn btn-sm btn-primary" title="View item">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- View Modal --}}
                                        <div class="modal fade" id="viewProductModal-{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Location</label>
                                                                            <select name="location" class="form-control"
                                                                                disabled>
                                                                                <option value="" selected disabled>
                                                                                    Select Location
                                                                                </option>
                                                                                <option value="ORTIGAS"
                                                                                    {{ old('location', $product->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                    ORTIGAS</option>
                                                                                <option value="A-JUAN"
                                                                                    {{ old('location', $product->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                    A-JUAN</option>
                                                                                <option value="MARIKINA"
                                                                                    {{ old('location', $product->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                    MARIKINA</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label for="">Category</label>
                                                                            <select name="category_id"
                                                                                class="form-control" disabled>
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>Brand</label>
                                                                            <select name="brand" class="form-control"
                                                                                disabled>
                                                                                @foreach ($brands as $brand)
                                                                                    <option value="{{ $brand->name }}">
                                                                                        {{ $brand->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Model</label>
                                                                            <input type="text" name="model"
                                                                                class="form-control" disabled
                                                                                value="{{ old('model', $product->model) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>SKU</label>
                                                                            <input type="text" name="sku"
                                                                                class="form-control"
                                                                                value="{{ old('sku', $product->sku) }}"
                                                                                disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Product Code</label>
                                                                            <input type="text" name="productcode"
                                                                                class="form-control" disabled
                                                                                value="{{ old('productcode', $product->productcode) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>UOM</label>
                                                                            <input type="text" name="uom"
                                                                                class="form-control" disabled
                                                                                value="{{ old('uom', $product->uom) }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Quantity</label>
                                                                            <input type="number" min="1"
                                                                                name="quantity" class="form-control"
                                                                                disabled
                                                                                value="{{ old('quantity', $product->quantity) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            @php
                                                                                $currentStatus;
                                                                                if ($product->quantity === 0) {
                                                                                    $currentStatus = 'Out of Stock';
                                                                                } elseif ($product->quantity < 20) {
                                                                                    $currentStatus = 'Low Stock';
                                                                                } else {
                                                                                    $currentStatus = 'Available';
                                                                                }
                                                                            @endphp
                                                                            <label>Status</label>
                                                                            <input type="text" name="status"
                                                                                class="form-control"
                                                                                value="{{ $currentStatus }}" disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control" rows="6" disabled>{{ old('description', $product->description) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                    class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="11">No Items Available</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $ajuan_products->links() }}
                        </div>
                    </div>

                    {{-- MARIKINA TAB --}}
                    <div class="tab-pane fade {{ Request::get('tab') === 'marikina' ? ' show active' : '' }}" id="marikina" role="tabpanel" aria-labelledby="marikina-tab" wire:ignore.self>
                        <div class="table-responsive mb-3">
                            <table class="table table-striped table-bordered table-hover table-sm">
                                <thead class="table-dark">
                                    <tr class="text-nowrap">
                                        <th class="text-center align-middle">ID</th>
                                        <th class="text-center align-middle">Location</th>
                                        <th class="text-center align-middle">Category</th>
                                        <th class="text-center align-middle">Brand</th>
                                        <th class="text-center align-middle">Model</th>
                                        <th class="text-center align-middle">SKU</th>
                                        <th class="text-center align-middle">Product Code</th>
                                        <th class="text-center align-middle">UOM</th>
                                        <th class="text-center align-middle">Description</th>
                                        <th class="text-center align-middle">Quantity</th>
                                        <th class="text-center align-middle">Status</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($marikina_products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td class="text-nowrap">{{ $product->location }}</td>
                                            <td class="text-nowrap">
                                                @if ($product->category)
                                                    {{ $product->category->name }}
                                                @else
                                                    No Category
                                                @endif
                                            </td>
                                            <td class="text-nowrap">{{ $product->brand }}</td>
                                            <td class="text-nowrap">{{ $product->model }}</td>
                                            <td class="text-nowrap">{{ $product->sku }}</td>
                                            <td class="text-nowrap">{{ $product->productcode }}</td>
                                            <td class="text-nowrap">{{ $product->uom }}</td>
                                            <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">
                                                {{ $product->description }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                @if ($product->quantity === 0)
                                                    <label class="badge badge-danger"
                                                        title="This item is almost out of stock">Out of
                                                        Stock</label>
                                                @elseif($product->quantity < 20)
                                                    <label class="badge rounded btn-warning"
                                                        title="This item is unavailable">Low
                                                        Stock</label>
                                                @else
                                                    <label class="badge rounded btn-success"
                                                        title="This item is available">Available</label>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#viewProductModal-{{ $product->id }}"
                                                    class="btn btn-sm btn-primary" title="View item">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- View Modal --}}
                                        <div class="modal fade" id="viewProductModal-{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Location</label>
                                                                            <select name="location" class="form-control"
                                                                                disabled>
                                                                                <option value="" selected disabled>
                                                                                    Select Location
                                                                                </option>
                                                                                <option value="ORTIGAS"
                                                                                    {{ old('location', $product->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                    ORTIGAS</option>
                                                                                <option value="A-JUAN"
                                                                                    {{ old('location', $product->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                    A-JUAN</option>
                                                                                <option value="MARIKINA"
                                                                                    {{ old('location', $product->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                    MARIKINA</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label for="">Category</label>
                                                                            <select name="category_id"
                                                                                class="form-control" disabled>
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>Brand</label>
                                                                            <select name="brand" class="form-control"
                                                                                disabled>
                                                                                @foreach ($brands as $brand)
                                                                                    <option value="{{ $brand->name }}">
                                                                                        {{ $brand->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Model</label>
                                                                            <input type="text" name="model"
                                                                                class="form-control" disabled
                                                                                value="{{ old('model', $product->model) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>SKU</label>
                                                                            <input type="text" name="sku"
                                                                                class="form-control"
                                                                                value="{{ old('sku', $product->sku) }}"
                                                                                disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Product Code</label>
                                                                            <input type="text" name="productcode"
                                                                                class="form-control" disabled
                                                                                value="{{ old('productcode', $product->productcode) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>UOM</label>
                                                                            <input type="text" name="uom"
                                                                                class="form-control" disabled
                                                                                value="{{ old('uom', $product->uom) }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Quantity</label>
                                                                            <input type="number" min="1"
                                                                                name="quantity" class="form-control"
                                                                                disabled
                                                                                value="{{ old('quantity', $product->quantity) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            @php
                                                                                $currentStatus;
                                                                                if ($product->quantity === 0) {
                                                                                    $currentStatus = 'Out of Stock';
                                                                                } elseif ($product->quantity < 20) {
                                                                                    $currentStatus = 'Low Stock';
                                                                                } else {
                                                                                    $currentStatus = 'Available';
                                                                                }
                                                                            @endphp
                                                                            <label>Status</label>
                                                                            <input type="text" name="status"
                                                                                class="form-control"
                                                                                value="{{ $currentStatus }}" disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control" rows="6" disabled>{{ old('description', $product->description) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                    class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="11">No Items Available</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $marikina_products->links() }}
                        </div>
                    </div>

                    {{-- ORTIGAS TAB --}}
                    <div class="tab-pane fade {{ Request::get('tab') === 'ortigas' ? ' show active' : '' }}" id="ortigas" role="tabpanel" aria-labelledby="ortigas-tab" wire:ignore.self>
                        <div class="table-responsive mb-3">
                            <table class="table table-striped table-bordered table-hover table-sm">
                                <thead class="table-dark">
                                    <tr class="text-nowrap">
                                        <th class="text-center align-middle">ID</th>
                                        <th class="text-center align-middle">Location</th>
                                        <th class="text-center align-middle">Category</th>
                                        <th class="text-center align-middle">Brand</th>
                                        <th class="text-center align-middle">Model</th>
                                        <th class="text-center align-middle">SKU</th>
                                        <th class="text-center align-middle">Product Code</th>
                                        <th class="text-center align-middle">UOM</th>
                                        <th class="text-center align-middle">Description</th>
                                        <th class="text-center align-middle">Quantity</th>
                                        <th class="text-center align-middle">Status</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ortigas_products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td class="text-nowrap">{{ $product->location }}</td>
                                            <td class="text-nowrap">
                                                @if ($product->category)
                                                    {{ $product->category->name }}
                                                @else
                                                    No Category
                                                @endif
                                            </td>
                                            <td class="text-nowrap">{{ $product->brand }}</td>
                                            <td class="text-nowrap">{{ $product->model }}</td>
                                            <td class="text-nowrap">{{ $product->sku }}</td>
                                            <td class="text-nowrap">{{ $product->productcode }}</td>
                                            <td class="text-nowrap">{{ $product->uom }}</td>
                                            <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">
                                                {{ $product->description }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                @if ($product->quantity === 0)
                                                    <label class="badge badge-danger"
                                                        title="This item is almost out of stock">Out of
                                                        Stock</label>
                                                @elseif($product->quantity < 20)
                                                    <label class="badge rounded btn-warning"
                                                        title="This item is unavailable">Low
                                                        Stock</label>
                                                @else
                                                    <label class="badge rounded btn-success"
                                                        title="This item is available">Available</label>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#viewProductModal-{{ $product->id }}"
                                                    class="btn btn-sm btn-primary" title="View item">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- View Modal --}}
                                        <div class="modal fade" id="viewProductModal-{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Location</label>
                                                                            <select name="location" class="form-control"
                                                                                disabled>
                                                                                <option value="" selected disabled>
                                                                                    Select Location
                                                                                </option>
                                                                                <option value="ORTIGAS"
                                                                                    {{ old('location', $product->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                    ORTIGAS</option>
                                                                                <option value="A-JUAN"
                                                                                    {{ old('location', $product->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                    A-JUAN</option>
                                                                                <option value="MARIKINA"
                                                                                    {{ old('location', $product->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                    MARIKINA</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label for="">Category</label>
                                                                            <select name="category_id"
                                                                                class="form-control" disabled>
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>Brand</label>
                                                                            <select name="brand" class="form-control"
                                                                                disabled>
                                                                                @foreach ($brands as $brand)
                                                                                    <option value="{{ $brand->name }}">
                                                                                        {{ $brand->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Model</label>
                                                                            <input type="text" name="model"
                                                                                class="form-control" disabled
                                                                                value="{{ old('model', $product->model) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>SKU</label>
                                                                            <input type="text" name="sku"
                                                                                class="form-control"
                                                                                value="{{ old('sku', $product->sku) }}"
                                                                                disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Product Code</label>
                                                                            <input type="text" name="productcode"
                                                                                class="form-control" disabled
                                                                                value="{{ old('productcode', $product->productcode) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>UOM</label>
                                                                            <input type="text" name="uom"
                                                                                class="form-control" disabled
                                                                                value="{{ old('uom', $product->uom) }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label>Quantity</label>
                                                                            <input type="number" min="1"
                                                                                name="quantity" class="form-control"
                                                                                disabled
                                                                                value="{{ old('quantity', $product->quantity) }}" />
                                                                        </div>
                                                                        <div class="col">
                                                                            @php
                                                                                $currentStatus;
                                                                                if ($product->quantity === 0) {
                                                                                    $currentStatus = 'Out of Stock';
                                                                                } elseif ($product->quantity < 20) {
                                                                                    $currentStatus = 'Low Stock';
                                                                                } else {
                                                                                    $currentStatus = 'Available';
                                                                                }
                                                                            @endphp
                                                                            <label>Status</label>
                                                                            <input type="text" name="status"
                                                                                class="form-control"
                                                                                value="{{ $currentStatus }}" disabled />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control" rows="6" disabled>{{ old('description', $product->description) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                    class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="11">No Items Available</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $ortigas_products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // Retrieve the active tab from the browser's sessionStorage
            var activeTab = sessionStorage.getItem('activeTab');

            if (activeTab) {
                // If an active tab is stored, show it
                $('#' + activeTab).tab('show');
            } else {
                // If no active tab is stored, show the default active tab
                $('.nav-tabs button:first').tab('show');
            }

            // Store the active tab in the browser's sessionStorage when changing tabs
            $('.nav-tabs button').on('click', function(e) {
                var activeTab = $(e.target).attr('data-target').substr(1);
                sessionStorage.setItem('activeTab', activeTab);
            });
        });
    </script>
    @push('script')
        <script>
            window.addEventListener('close-modal', event => {
                $('#addInventoryModal').modal('hide');
                $('#updateProductModal').modal('hide');
                $('#deleteModal').modal('hide');
            });
        </script>


    @endpush
@endsection
