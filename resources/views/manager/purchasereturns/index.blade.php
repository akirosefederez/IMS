@extends('layouts.manager')
@section('title', 'Purchase Return')
@section('content')
    @include('manager.purchasereturns.purchasereturns-modal')
    <div>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @elseif (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @endif
    </div>
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="mt-2">PURCHASE RETURN
                <a class="btn btn-warning btn-sm text-white float-right" data-toggle="modal" data-target="#staticBackdrop"
                    style="margin-right: 5px;" title="Generate DR Form PDF File">Purchase Return Slip</a>
                {{-- <a href="{{ url('manager/returns/create') }}" class="btn btn-primary btn-sm text-white float-end"
                    style="margin-right: 5px;">CREATE</a> --}}
                <a href="{{ url('manager/purchasereturns/purchasereturnsPDF') }}" class="btn btn-sm text-white float-right"
                    style="margin-right: 5px; background-color: rgb(196, 80, 80);"
                    title="Export table data to PDF file">Export to PDF</a>
                <a href="#" data-toggle="modal" data-target="#addOrderModal"
                    class="btn btn-primary btn-sm text-white float-right" style="margin-right: 5px;"
                    title="Checkout items">Add Item</a>

            </h3>
        </div>

        <div class="card-body" style="background-color: #ffffff">
            <div class="mb-3">
                <form action="{{ route('purchasereturns.search2') }}" method="GET" role="search">
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
                                    href="{{ url('manager/purchasereturns') }}"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- NAVS AND TABS --}}
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link{{ Request::get('tab') === 'ajuan' ? ' show active' : '' }}" id="ajuan-tab"
                            data-toggle="tab" data-target="#ajuan" type="button" role="tab" aria-controls="ajuan"
                            aria-selected="{{ Request::get('tab') === 'ajuan' ? 'true' : 'false' }}"
                            wire:ignore>A-JUAN</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link{{ Request::get('tab') === 'marikina' ? ' show active' : '' }}"
                            id="marikina-tab" data-toggle="tab" data-target="#marikina" type="button" role="tab"
                            aria-controls="marikina"
                            aria-selected="{{ Request::get('tab') === 'marikina' ? 'true' : 'false' }}"
                            wire:ignore>MARIKINA</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link{{ Request::get('tab') === 'ortigas' ? ' show active' : '' }}"
                            id="ortigas-tab" data-toggle="tab" data-target="#ortigas" type="button" role="tab"
                            aria-controls="ortigas"
                            aria-selected="{{ Request::get('tab') === 'ortigas' ? 'true' : 'false' }}"
                            wire:ignore>ORTIGAS</button>
                    </li>
                </ul>

                {{-- TAB CONTENT --}}
                <div class="tab-content" id="myTabContent">
                    {{-- AJUAN --}}
                    <div class="tab-pane fade {{ Request::get('tab') === 'ajuan' ? ' show active' : '' }}" id="ajuan"
                        role="tabpanel" aria-labelledby="ajuan-tab" wire:ignore.self>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr class="text-nowrap">
                                        {{-- <th class="font-weight-bold text-center align-middle">Stockout ID</th> --}}
                                        <th class="font-weight-bold text-center align-middle"> Location</th>
                                        <th class="font-weight-bold text-center align-middle">Checkout Date</th>
                                        <th class="font-weight-bold text-center align-middle">Client</th>
                                        <th class="font-weight-bold text-center align-middle">DR No.</th>
                                        <th class="font-weight-bold text-center align-middle">PRS No.</th>
                                        <th class="font-weight-bold text-center align-middle">SKU</th>
                                        <th class="font-weight-bold text-center align-middle">Product code</th>
                                        <th class="font-weight-bold text-center align-middle">Model</th>
                                        <th class="font-weight-bold text-center align-middle">UOM</th>
                                        <th class="font-weight-bold text-center align-middle">Description</th>
                                        <th class="font-weight-bold text-center align-middle">Serial No.</th>
                                        <th class="font-weight-bold text-center align-middle">Quantity</th>
                                        <th class="font-weight-bold text-center align-middle">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ajuan_purchase_returns as $purchase_return)
                                        <tr>
                                            {{-- -<td class="text-nowrap">{{ $purchase_return->order_id }}</td>- --}}
                                            <td class="text-nowrap">{{ $purchase_return->location }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->checkoutdate }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->client }}</td>
                                            <td>{{ $purchase_return->drnumber }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->prsnumber }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->sku }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->productcode }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->model }}</td>
                                            <td>{{ $purchase_return->uom }}</td>
                                            <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">
                                                {{ $purchase_return->itemdescription }}</td>
                                            <td class="text-truncate"
                                                style="word-wrap: break-word;min-width: 250px;max-width: 250px;">
                                                {{ $purchase_return->serialnumber }}</td>
                                            <td>{{ $purchase_return->quantity }}</td>
                                            <td class="text-nowrap">

                                                {{-- View Button --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#viewCheckoutModal-{{ $purchase_return->id }}"
                                                    class="btn btn-sm btn-primary" title="View item">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit Button --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#updateCheckoutModal-{{ $purchase_return->id }}"
                                                    class="btn btn-sm btn-warning" title="Update item">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Delete Button --}}
                                                <a class="btn btn-sm btn-danger" role="button" data-toggle="modal"
                                                    title="Delete item"
                                                    data-target="#modal-delete-{{ $purchase_return->id }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>


                                            </td>
                                            {{-- -
                                <td><a href="{{ url('manager/returns/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ url('manager/returns/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a></td> - --}}
                                        </tr>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="modal-delete-{{ $purchase_return->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Item
                                                        </h3>
                                                        <a class="btn-close" class="btn" data-dismiss="modal"
                                                            aria-label="Close"></a>
                                                    </div>

                                                    <div class="modal-body">
                                                        <strong class="text-danger mb-2">Warning!</strong> This action is
                                                        irreversible.
                                                        <h6>Are you sure you want to delete this item and its data?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="{{ url('manager/purchasereturns/' . $purchase_return->id . '/delete') }}"
                                                            class="btn btn-sm btn-danger">Yes. Delete</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade" id="updateCheckoutModal-{{ $purchase_return->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Edit Item</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ url('manager/purchasereturns/' . $purchase_return->id) }}"
                                                            method="POST"enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="location">Location</label>
                                                                        <select name="location" id="location"
                                                                            class="form-control" required disabled>
                                                                            <option value="" selected disabled>Select
                                                                                Location
                                                                            </option>
                                                                            <option value="ORTIGAS"
                                                                                {{ old('location', $purchase_return->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                ORTIGAS</option>
                                                                            <option value="A-JUAN"
                                                                                {{ old('location', $purchase_return->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                A-JUAN</option>
                                                                            <option value="MARIKINA"
                                                                                {{ old('location', $purchase_return->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                MARIKINA</option>
                                                                        </select>
                                                                        @error('location')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="checkoutdate">Checkout date</label>
                                                                        <input type="date" required name="checkoutdate"
                                                                            id="checkoutdate" class="form-control"
                                                                            value="{{ old('checkoutdate', $purchase_return->checkoutdate) }}" />
                                                                        @error('checkoutdate')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="client">Client</label>
                                                                        <input type="text" required name="client"
                                                                            id="client" class="form-control"
                                                                            value="{{ old('client', $purchase_return->client) }}"
                                                                            placeholder="Enter client name" />
                                                                        @error('client')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="drnumber">DR No.</label>
                                                                        <input type="text" required name="drnumber"
                                                                            id="drnumber" class="form-control"
                                                                            value="{{ old('drnumber', $purchase_return->drnumber) }}"
                                                                            placeholder="Enter DR no." />
                                                                        @error('drnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="prsnumber">PRS No.</label>
                                                                        <input type="text" required name="prsnumber"
                                                                            id="prsnumber" class="form-control"
                                                                            value="{{ old('prsnumber', $purchase_return->prsnumber) }}"
                                                                            placeholder="Enter PRS No." />
                                                                        @error('prsnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="site">Site/Event</label>
                                                                        <input type="text" required name="site"
                                                                            id="site" class="form-control"
                                                                            value="{{ old('site', $purchase_return->site) }}"
                                                                            placeholder="Enter site name" />
                                                                        @error('site')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" required name="address"
                                                                            id="address" class="form-control"
                                                                            value="{{ old('address', $purchase_return->address) }}"
                                                                            placeholder="Enter address" />
                                                                        @error('address')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" name="sku"
                                                                            id="sku" class="form-control"
                                                                            value="{{ old('sku', $purchase_return->sku) }}"
                                                                            placeholder="Enter SKU" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="productcode">Product
                                                                            Code</label>
                                                                        <input type="text" name="productcode"
                                                                            id="productcode" class="form-control"
                                                                            value="{{ old('productcode', $purchase_return->productcode) }}"
                                                                            placeholder="Enter product code" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="model">Model</label>
                                                                        <input type="text" name="model"
                                                                            id="model" class="form-control"
                                                                            value="{{ old('model', $purchase_return->model) }}"
                                                                            placeholder="Enter model" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="number" name="quantity"
                                                                            id="quantity" class="form-control"
                                                                            value="{{ old('quantity', $purchase_return->quantity) }}"
                                                                            placeholder="Enter quantity" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="uom">UOM</label>
                                                                        <input type="text" name="uom"
                                                                            id="uom" class="form-control"
                                                                            value="{{ old('uom', $purchase_return->uom) }}"
                                                                            placeholder="Enter UOM" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="serialnumber">Serial No.</label>
                                                                        <textarea name="serialnumber" id="serialnumber" class="form-control" rows="1" placeholder="Enter serial no.">{{ old('serialnumber', $purchase_return->serialnumber) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="itemdescription">Item
                                                                            Description</label>
                                                                        <textarea type="text" name="itemdescription" id="itemdescription" class="form-control"
                                                                            placeholder="Enter description">{{ old('itemdescription', $purchase_return->itemdescription) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="submitButt"
                                                            class="btn btn-sm btn-primary">Save</button>
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-sm btn-secondary">Cancel</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- View Modal --}}
                                        <div class="modal fade" id="viewCheckoutModal-{{ $purchase_return->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="location">Location</label>
                                                                        <select name="location" id="location"
                                                                            class="form-control" required disabled>
                                                                            <option value="" selected>Select Location
                                                                            </option>
                                                                            <option value="ORTIGAS"
                                                                                {{ old('location', $purchase_return->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                ORTIGAS</option>
                                                                            <option value="A-JUAN"
                                                                                {{ old('location', $purchase_return->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                A-JUAN</option>
                                                                            <option value="MARIKINA"
                                                                                {{ old('location', $purchase_return->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                MARIKINA</option>
                                                                        </select>
                                                                        @error('location')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="checkoutdate">Checkout date</label>
                                                                        <input type="date" required name="checkoutdate"
                                                                            id="checkoutdate" class="form-control"
                                                                            disabled
                                                                            value="{{ old('checkoutdate', $purchase_return->checkoutdate) }}" />
                                                                        @error('checkoutdate')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="client">Client</label>
                                                                        <input type="text" required name="client"
                                                                            id="client" disabled class="form-control"
                                                                            value="{{ old('client', $purchase_return->client) }}"
                                                                            placeholder="Enter client name" />
                                                                        @error('client')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="drnumber">DR No.</label>
                                                                        <input type="text" required name="drnumber"
                                                                            id="drnumber" disabled class="form-control"
                                                                            value="{{ old('drnumber', $purchase_return->drnumber) }}"
                                                                            placeholder="Enter DR no." />
                                                                        @error('drnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="prsnumber">PRS No.</label>
                                                                        <input type="text" required name="prsnumber"
                                                                            id="prsnumber" disabled class="form-control"
                                                                            value="{{ old('prsnumber', $purchase_return->prsnumber) }}"
                                                                            placeholder="Enter PRS No." />
                                                                        @error('prsnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="site">Site/Event</label>
                                                                        <input type="text" required name="site"
                                                                            id="site" disabled class="form-control"
                                                                            value="{{ old('site', $purchase_return->site) }}"
                                                                            placeholder="Enter site" />
                                                                        @error('site')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" required name="address"
                                                                            id="address" disabled class="form-control"
                                                                            value="{{ old('address', $purchase_return->address) }}"
                                                                            placeholder="Enter address name" />
                                                                        @error('address')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" name="sku"
                                                                            id="sku" disabled class="form-control"
                                                                            value="{{ old('sku', $purchase_return->sku) }}"
                                                                            placeholder="Enter SKU" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="productcode">Product Code</label>
                                                                        <input type="text" name="productcode"
                                                                            id="productcode" disabled class="form-control"
                                                                            value="{{ old('productcode', $purchase_return->productcode) }}"
                                                                            placeholder="Enter product code" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="model">Model</label>
                                                                        <input type="text" name="model"
                                                                            id="model" disabled class="form-control"
                                                                            value="{{ old('model', $purchase_return->model) }}"
                                                                            placeholder="Enter model" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="text" name="quantity"
                                                                            id="quantity" disabled class="form-control"
                                                                            value="{{ old('quantity', $purchase_return->quantity) }}"
                                                                            placeholder="Enter quantity" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="uom">UOM</label>
                                                                        <input type="text" name="uom"
                                                                            id="uom" disabled class="form-control"
                                                                            value="{{ old('uom', $purchase_return->uom) }}"
                                                                            placeholder="Enter UOM" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="serialnumber">Serial No.</label>
                                                                        <textarea name="serialnumber" id="serialnumber" disabled class="form-control" rows="1"
                                                                            placeholder="Enter serial no.">{{ old('serialnumber', $purchase_return->serialnumber) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="itemdescription">Item
                                                                            Description</label>
                                                                        <textarea rows="6" type="text" name="itemdescription" id="itemdescription" class="form-control" disabled
                                                                            placeholder="Enter description">{{ old('itemdescription', $purchase_return->itemdescription) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-sm btn-secondary btn-close">Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="17">No Items Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $ajuan_purchase_returns->links() }}
                            </div>
                        </div>
                    </div>

                    {{-- MARIKINA --}}
                    <div class="tab-pane fade {{ Request::get('tab') === 'marikina' ? ' show active' : '' }}" id="marikina"
                        role="tabpanel" aria-labelledby="marikina-tab" wire:ignore.self>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr class="text-nowrap">
                                        {{-- <th class="font-weight-bold text-center align-middle">Stockout ID</th> --}}
                                        <th class="font-weight-bold text-center align-middle"> Location</th>
                                        <th class="font-weight-bold text-center align-middle">Checkout Date</th>
                                        <th class="font-weight-bold text-center align-middle">Client</th>
                                        <th class="font-weight-bold text-center align-middle">DR No.</th>
                                        <th class="font-weight-bold text-center align-middle">PRS No.</th>
                                        <th class="font-weight-bold text-center align-middle">SKU</th>
                                        <th class="font-weight-bold text-center align-middle">Product code</th>
                                        <th class="font-weight-bold text-center align-middle">Model</th>
                                        <th class="font-weight-bold text-center align-middle">UOM</th>
                                        <th class="font-weight-bold text-center align-middle">Description</th>
                                        <th class="font-weight-bold text-center align-middle">Serial No.</th>
                                        <th class="font-weight-bold text-center align-middle">Quantity</th>
                                        <th class="font-weight-bold text-center align-middle">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($marikina_purchase_returns as $purchase_return)
                                        <tr>
                                            {{-- -<td class="text-nowrap">{{ $purchase_return->order_id }}</td>- --}}
                                            <td class="text-nowrap">{{ $purchase_return->location }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->checkoutdate }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->client }}</td>
                                            <td>{{ $purchase_return->drnumber }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->prsnumber }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->sku }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->productcode }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->model }}</td>
                                            <td>{{ $purchase_return->uom }}</td>
                                            <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">
                                                {{ $purchase_return->itemdescription }}</td>
                                            <td class="text-truncate" style="word-wrap: break-word;min-width: 250px;max-width: 250px;">
                                                {{ $purchase_return->serialnumber }}</td>
                                            <td>{{ $purchase_return->quantity }}</td>
                                            <td class="text-nowrap">

                                                {{-- View Button --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#viewCheckoutModal-{{ $purchase_return->id }}"
                                                    class="btn btn-sm btn-primary" title="View item">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit Button --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#updateCheckoutModal-{{ $purchase_return->id }}"
                                                    class="btn btn-sm btn-warning" title="Update item">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Delete Button --}}
                                                <a class="btn btn-sm btn-danger" role="button" data-toggle="modal" title="Delete item"
                                                    data-target="#modal-delete-{{ $purchase_return->id }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>


                                            </td>
                                            {{-- -
                                    <td><a href="{{ url('manager/returns/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{ url('manager/returns/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a></td> - --}}
                                        </tr>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="modal-delete-{{ $purchase_return->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h3>
                                                        <a class="btn-close" class="btn" data-dismiss="modal"
                                                            aria-label="Close"></a>
                                                    </div>

                                                    <div class="modal-body">
                                                        <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                                                        <h6>Are you sure you want to delete this item and its data?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="{{ url('manager/purchasereturns/' . $purchase_return->id . '/delete') }}"
                                                            class="btn btn-sm btn-danger">Yes. Delete</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade" id="updateCheckoutModal-{{ $purchase_return->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Edit Item</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('manager/purchasereturns/' . $purchase_return->id) }}"
                                                            method="POST"enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="location">Location</label>
                                                                        <select name="location" id="location" class="form-control"
                                                                            required disabled>
                                                                            <option value="" selected disabled>Select Location
                                                                            </option>
                                                                            <option value="ORTIGAS"
                                                                                {{ old('location', $purchase_return->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                ORTIGAS</option>
                                                                            <option value="A-JUAN"
                                                                                {{ old('location', $purchase_return->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                A-JUAN</option>
                                                                            <option value="MARIKINA"
                                                                                {{ old('location', $purchase_return->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                MARIKINA</option>
                                                                        </select>
                                                                        @error('location')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="checkoutdate">Checkout date</label>
                                                                        <input type="date" required name="checkoutdate"
                                                                            id="checkoutdate" class="form-control"
                                                                            value="{{ old('checkoutdate', $purchase_return->checkoutdate) }}" />
                                                                        @error('checkoutdate')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="client">Client</label>
                                                                        <input type="text" required name="client" id="client"
                                                                            class="form-control"
                                                                            value="{{ old('client', $purchase_return->client) }}"
                                                                            placeholder="Enter client name" />
                                                                        @error('client')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="drnumber">DR No.</label>
                                                                        <input type="text" required name="drnumber" id="drnumber"
                                                                            class="form-control"
                                                                            value="{{ old('drnumber', $purchase_return->drnumber) }}"
                                                                            placeholder="Enter DR no." />
                                                                        @error('drnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="prsnumber">PRS No.</label>
                                                                        <input type="text" required name="prsnumber"
                                                                            id="prsnumber" class="form-control"
                                                                            value="{{ old('prsnumber', $purchase_return->prsnumber) }}"
                                                                            placeholder="Enter PRS No." />
                                                                        @error('prsnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="site">Site/Event</label>
                                                                        <input type="text" required name="site" id="site"
                                                                            class="form-control"
                                                                            value="{{ old('site', $purchase_return->site) }}"
                                                                            placeholder="Enter site name" />
                                                                        @error('site')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" required name="address" id="address"
                                                                            class="form-control"
                                                                            value="{{ old('address', $purchase_return->address) }}"
                                                                            placeholder="Enter address" />
                                                                        @error('address')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" name="sku" id="sku"
                                                                            class="form-control"
                                                                            value="{{ old('sku', $purchase_return->sku) }}"
                                                                            placeholder="Enter SKU" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="productcode">Product
                                                                            Code</label>
                                                                        <input type="text" name="productcode" id="productcode"
                                                                            class="form-control"
                                                                            value="{{ old('productcode', $purchase_return->productcode) }}"
                                                                            placeholder="Enter product code" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="model">Model</label>
                                                                        <input type="text" name="model" id="model"
                                                                            class="form-control"
                                                                            value="{{ old('model', $purchase_return->model) }}"
                                                                            placeholder="Enter model" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="number" name="quantity" id="quantity"
                                                                            class="form-control"
                                                                            value="{{ old('quantity', $purchase_return->quantity) }}"
                                                                            placeholder="Enter quantity" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="uom">UOM</label>
                                                                        <input type="text" name="uom" id="uom"
                                                                            class="form-control"
                                                                            value="{{ old('uom', $purchase_return->uom) }}"
                                                                            placeholder="Enter UOM" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="serialnumber">Serial No.</label>
                                                                        <textarea name="serialnumber" id="serialnumber" class="form-control" rows="1" placeholder="Enter serial no.">{{ old('serialnumber', $purchase_return->serialnumber) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="itemdescription">Item Description</label>
                                                                        <textarea type="text" name="itemdescription" id="itemdescription" class="form-control"
                                                                            placeholder="Enter description">{{ old('itemdescription', $purchase_return->itemdescription) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="submitButt"
                                                            class="btn btn-sm btn-primary">Save</button>
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-sm btn-secondary">Cancel</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- View Modal --}}
                                        <div class="modal fade" id="viewCheckoutModal-{{ $purchase_return->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="location">Location</label>
                                                                        <select name="location" id="location" class="form-control"
                                                                            required disabled>
                                                                            <option value="" selected>Select Location
                                                                            </option>
                                                                            <option value="ORTIGAS"
                                                                                {{ old('location', $purchase_return->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                ORTIGAS</option>
                                                                            <option value="A-JUAN"
                                                                                {{ old('location', $purchase_return->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                A-JUAN</option>
                                                                            <option value="MARIKINA"
                                                                                {{ old('location', $purchase_return->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                MARIKINA</option>
                                                                        </select>
                                                                        @error('location')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="checkoutdate">Checkout date</label>
                                                                        <input type="date" required name="checkoutdate"
                                                                            id="checkoutdate" class="form-control" disabled
                                                                            value="{{ old('checkoutdate', $purchase_return->checkoutdate) }}" />
                                                                        @error('checkoutdate')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="client">Client</label>
                                                                        <input type="text" required name="client" id="client"
                                                                            disabled class="form-control"
                                                                            value="{{ old('client', $purchase_return->client) }}"
                                                                            placeholder="Enter client name" />
                                                                        @error('client')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="drnumber">DR No.</label>
                                                                        <input type="text" required name="drnumber" id="drnumber"
                                                                            disabled class="form-control"
                                                                            value="{{ old('drnumber', $purchase_return->drnumber) }}"
                                                                            placeholder="Enter DR no." />
                                                                        @error('drnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="prsnumber">PRS No.</label>
                                                                        <input type="text" required name="prsnumber"
                                                                            id="prsnumber" disabled class="form-control"
                                                                            value="{{ old('prsnumber', $purchase_return->prsnumber) }}"
                                                                            placeholder="Enter PRS No." />
                                                                        @error('prsnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="site">Site/Event</label>
                                                                        <input type="text" required name="site" id="site"
                                                                            disabled class="form-control"
                                                                            value="{{ old('site', $purchase_return->site) }}"
                                                                            placeholder="Enter site" />
                                                                        @error('site')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" required name="address" id="address"
                                                                            disabled class="form-control"
                                                                            value="{{ old('address', $purchase_return->address) }}"
                                                                            placeholder="Enter address name" />
                                                                        @error('address')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" name="sku" id="sku" disabled
                                                                            class="form-control"
                                                                            value="{{ old('sku', $purchase_return->sku) }}"
                                                                            placeholder="Enter SKU" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="productcode">Product Code</label>
                                                                        <input type="text" name="productcode" id="productcode"
                                                                            disabled class="form-control"
                                                                            value="{{ old('productcode', $purchase_return->productcode) }}"
                                                                            placeholder="Enter product code" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="model">Model</label>
                                                                        <input type="text" name="model" id="model" disabled
                                                                            class="form-control"
                                                                            value="{{ old('model', $purchase_return->model) }}"
                                                                            placeholder="Enter model" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="text" name="quantity" id="quantity" disabled
                                                                            class="form-control"
                                                                            value="{{ old('quantity', $purchase_return->quantity) }}"
                                                                            placeholder="Enter quantity" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="uom">UOM</label>
                                                                        <input type="text" name="uom" id="uom" disabled
                                                                            class="form-control"
                                                                            value="{{ old('uom', $purchase_return->uom) }}"
                                                                            placeholder="Enter UOM" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="serialnumber">Serial No.</label>
                                                                        <textarea name="serialnumber" id="serialnumber"
                                                                            disabled class="form-control"
                                                                            rows="1"
                                                                            placeholder="Enter serial no.">{{ old('serialnumber', $purchase_return->serialnumber) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="itemdescription">Item Description</label>
                                                                        <textarea rows="6" type="text" name="itemdescription" id="itemdescription" class="form-control" disabled
                                                                            placeholder="Enter description">{{ old('itemdescription', $purchase_return->itemdescription) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-sm btn-secondary btn-close">Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="17">No Items Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $marikina_purchase_returns->links() }}
                            </div>
                        </div>
                    </div>

                    {{-- ORTIGAS --}}
                        <div class="tab-pane fade {{ Request::get('tab') === 'ortigas' ? ' show active' : '' }}" id="ortigas"
                        role="tabpanel" aria-labelledby="ortigas-tab" wire:ignore.self>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr class="text-nowrap">
                                        {{-- <th class="font-weight-bold text-center align-middle">Stockout ID</th> --}}
                                        <th class="font-weight-bold text-center align-middle"> Location</th>
                                        <th class="font-weight-bold text-center align-middle">Checkout Date</th>
                                        <th class="font-weight-bold text-center align-middle">Client</th>
                                        <th class="font-weight-bold text-center align-middle">DR No.</th>
                                        <th class="font-weight-bold text-center align-middle">PRS No.</th>
                                        <th class="font-weight-bold text-center align-middle">SKU</th>
                                        <th class="font-weight-bold text-center align-middle">Product code</th>
                                        <th class="font-weight-bold text-center align-middle">Model</th>
                                        <th class="font-weight-bold text-center align-middle">UOM</th>
                                        <th class="font-weight-bold text-center align-middle">Description</th>
                                        <th class="font-weight-bold text-center align-middle">Serial No.</th>
                                        <th class="font-weight-bold text-center align-middle">Quantity</th>
                                        <th class="font-weight-bold text-center align-middle">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ortigas_purchase_returns as $purchase_return)
                                        <tr>
                                            {{-- -<td class="text-nowrap">{{ $purchase_return->order_id }}</td>- --}}
                                            <td class="text-nowrap">{{ $purchase_return->location }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->checkoutdate }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->client }}</td>
                                            <td>{{ $purchase_return->drnumber }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->prsnumber }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->sku }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->productcode }}</td>
                                            <td class="text-nowrap">{{ $purchase_return->model }}</td>
                                            <td>{{ $purchase_return->uom }}</td>
                                            <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">
                                                {{ $purchase_return->itemdescription }}</td>
                                            <td class="text-truncate" style="word-wrap: break-word;min-width: 250px;max-width: 250px;">
                                                {{ $purchase_return->serialnumber }}</td>
                                            <td>{{ $purchase_return->quantity }}</td>
                                            <td class="text-nowrap">

                                                {{-- View Button --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#viewCheckoutModal-{{ $purchase_return->id }}"
                                                    class="btn btn-sm btn-primary" title="View item">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit Button --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#updateCheckoutModal-{{ $purchase_return->id }}"
                                                    class="btn btn-sm btn-warning" title="Update item">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                {{-- Delete Button --}}
                                                <a class="btn btn-sm btn-danger" role="button" data-toggle="modal" title="Delete item"
                                                    data-target="#modal-delete-{{ $purchase_return->id }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>


                                            </td>
                                            {{-- -
                                    <td><a href="{{ url('manager/returns/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{ url('manager/returns/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a></td> - --}}
                                        </tr>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="modal-delete-{{ $purchase_return->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h3>
                                                        <a class="btn-close" class="btn" data-dismiss="modal"
                                                            aria-label="Close"></a>
                                                    </div>

                                                    <div class="modal-body">
                                                        <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                                                        <h6>Are you sure you want to delete this item and its data?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="{{ url('manager/purchasereturns/' . $purchase_return->id . '/delete') }}"
                                                            class="btn btn-sm btn-danger">Yes. Delete</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade" id="updateCheckoutModal-{{ $purchase_return->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Edit Item</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('manager/purchasereturns/' . $purchase_return->id) }}"
                                                            method="POST"enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="location">Location</label>
                                                                        <select name="location" id="location" class="form-control"
                                                                            required disabled>
                                                                            <option value="" selected disabled>Select Location
                                                                            </option>
                                                                            <option value="ORTIGAS"
                                                                                {{ old('location', $purchase_return->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                ORTIGAS</option>
                                                                            <option value="A-JUAN"
                                                                                {{ old('location', $purchase_return->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                A-JUAN</option>
                                                                            <option value="MARIKINA"
                                                                                {{ old('location', $purchase_return->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                MARIKINA</option>
                                                                        </select>
                                                                        @error('location')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="checkoutdate">Checkout date</label>
                                                                        <input type="date" required name="checkoutdate"
                                                                            id="checkoutdate" class="form-control"
                                                                            value="{{ old('checkoutdate', $purchase_return->checkoutdate) }}" />
                                                                        @error('checkoutdate')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="client">Client</label>
                                                                        <input type="text" required name="client" id="client"
                                                                            class="form-control"
                                                                            value="{{ old('client', $purchase_return->client) }}"
                                                                            placeholder="Enter client name" />
                                                                        @error('client')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="drnumber">DR No.</label>
                                                                        <input type="text" required name="drnumber" id="drnumber"
                                                                            class="form-control"
                                                                            value="{{ old('drnumber', $purchase_return->drnumber) }}"
                                                                            placeholder="Enter DR no." />
                                                                        @error('drnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="prsnumber">PRS No.</label>
                                                                        <input type="text" required name="prsnumber"
                                                                            id="prsnumber" class="form-control"
                                                                            value="{{ old('prsnumber', $purchase_return->prsnumber) }}"
                                                                            placeholder="Enter PRS No." />
                                                                        @error('prsnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="site">Site/Event</label>
                                                                        <input type="text" required name="site" id="site"
                                                                            class="form-control"
                                                                            value="{{ old('site', $purchase_return->site) }}"
                                                                            placeholder="Enter site name" />
                                                                        @error('site')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" required name="address" id="address"
                                                                            class="form-control"
                                                                            value="{{ old('address', $purchase_return->address) }}"
                                                                            placeholder="Enter address" />
                                                                        @error('address')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" name="sku" id="sku"
                                                                            class="form-control"
                                                                            value="{{ old('sku', $purchase_return->sku) }}"
                                                                            placeholder="Enter SKU" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="productcode">Product
                                                                            Code</label>
                                                                        <input type="text" name="productcode" id="productcode"
                                                                            class="form-control"
                                                                            value="{{ old('productcode', $purchase_return->productcode) }}"
                                                                            placeholder="Enter product code" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="model">Model</label>
                                                                        <input type="text" name="model" id="model"
                                                                            class="form-control"
                                                                            value="{{ old('model', $purchase_return->model) }}"
                                                                            placeholder="Enter model" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="number" name="quantity" id="quantity"
                                                                            class="form-control"
                                                                            value="{{ old('quantity', $purchase_return->quantity) }}"
                                                                            placeholder="Enter quantity" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="uom">UOM</label>
                                                                        <input type="text" name="uom" id="uom"
                                                                            class="form-control"
                                                                            value="{{ old('uom', $purchase_return->uom) }}"
                                                                            placeholder="Enter UOM" disabled />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="serialnumber">Serial No.</label>
                                                                        <textarea name="serialnumber" id="serialnumber" class="form-control" rows="1" placeholder="Enter serial no.">{{ old('serialnumber', $purchase_return->serialnumber) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="itemdescription">Item Description</label>
                                                                        <textarea type="text" name="itemdescription" id="itemdescription" class="form-control"
                                                                            placeholder="Enter description">{{ old('itemdescription', $purchase_return->itemdescription) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="submitButt"
                                                            class="btn btn-sm btn-primary">Save</button>
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-sm btn-secondary">Cancel</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- View Modal --}}
                                        <div class="modal fade" id="viewCheckoutModal-{{ $purchase_return->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                                        <a class="btn" data-dismiss="modal" aria-label="Close">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="location">Location</label>
                                                                        <select name="location" id="location" class="form-control"
                                                                            required disabled>
                                                                            <option value="" selected>Select Location
                                                                            </option>
                                                                            <option value="ORTIGAS"
                                                                                {{ old('location', $purchase_return->location) == 'ORTIGAS' ? 'selected' : '' }}>
                                                                                ORTIGAS</option>
                                                                            <option value="A-JUAN"
                                                                                {{ old('location', $purchase_return->location) == 'A-JUAN' ? 'selected' : '' }}>
                                                                                A-JUAN</option>
                                                                            <option value="MARIKINA"
                                                                                {{ old('location', $purchase_return->location) == 'MARIKINA' ? 'selected' : '' }}>
                                                                                MARIKINA</option>
                                                                        </select>
                                                                        @error('location')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="checkoutdate">Checkout date</label>
                                                                        <input type="date" required name="checkoutdate"
                                                                            id="checkoutdate" class="form-control" disabled
                                                                            value="{{ old('checkoutdate', $purchase_return->checkoutdate) }}" />
                                                                        @error('checkoutdate')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="client">Client</label>
                                                                        <input type="text" required name="client" id="client"
                                                                            disabled class="form-control"
                                                                            value="{{ old('client', $purchase_return->client) }}"
                                                                            placeholder="Enter client name" />
                                                                        @error('client')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="drnumber">DR No.</label>
                                                                        <input type="text" required name="drnumber" id="drnumber"
                                                                            disabled class="form-control"
                                                                            value="{{ old('drnumber', $purchase_return->drnumber) }}"
                                                                            placeholder="Enter DR no." />
                                                                        @error('drnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="prsnumber">PRS No.</label>
                                                                        <input type="text" required name="prsnumber"
                                                                            id="prsnumber" disabled class="form-control"
                                                                            value="{{ old('prsnumber', $purchase_return->prsnumber) }}"
                                                                            placeholder="Enter PRS No." />
                                                                        @error('prsnumber')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="site">Site/Event</label>
                                                                        <input type="text" required name="site" id="site"
                                                                            disabled class="form-control"
                                                                            value="{{ old('site', $purchase_return->site) }}"
                                                                            placeholder="Enter site" />
                                                                        @error('site')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" required name="address" id="address"
                                                                            disabled class="form-control"
                                                                            value="{{ old('address', $purchase_return->address) }}"
                                                                            placeholder="Enter address name" />
                                                                        @error('address')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="sku">SKU</label>
                                                                        <input type="text" name="sku" id="sku" disabled
                                                                            class="form-control"
                                                                            value="{{ old('sku', $purchase_return->sku) }}"
                                                                            placeholder="Enter SKU" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="productcode">Product Code</label>
                                                                        <input type="text" name="productcode" id="productcode"
                                                                            disabled class="form-control"
                                                                            value="{{ old('productcode', $purchase_return->productcode) }}"
                                                                            placeholder="Enter product code" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="model">Model</label>
                                                                        <input type="text" name="model" id="model" disabled
                                                                            class="form-control"
                                                                            value="{{ old('model', $purchase_return->model) }}"
                                                                            placeholder="Enter model" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="text" name="quantity" id="quantity" disabled
                                                                            class="form-control"
                                                                            value="{{ old('quantity', $purchase_return->quantity) }}"
                                                                            placeholder="Enter quantity" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="uom">UOM</label>
                                                                        <input type="text" name="uom" id="uom" disabled
                                                                            class="form-control"
                                                                            value="{{ old('uom', $purchase_return->uom) }}"
                                                                            placeholder="Enter UOM" />
                                                                    </div>

                                                                    <div class="col">
                                                                        <label for="serialnumber">Serial No.</label>
                                                                        <textarea name="serialnumber" id="serialnumber"
                                                                            disabled class="form-control"
                                                                            rows="1"
                                                                            placeholder="Enter serial no.">{{ old('serialnumber', $purchase_return->serialnumber) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <label for="itemdescription">Item Description</label>
                                                                        <textarea rows="6" type="text" name="itemdescription" id="itemdescription" class="form-control" disabled
                                                                            placeholder="Enter description">{{ old('itemdescription', $purchase_return->itemdescription) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-sm btn-secondary btn-close">Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="17">No Items Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $ortigas_purchase_returns->links() }}
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.deleteOrderButton').click(function(e) {
                e.preventDefault();

                var item_id = $(this.val());
                $('#item_id').val(item_id);

                $('#deleteOrderModal').modal('show');

            });
        });
    </script>
    <script>
        $(document).ready(function () {
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
            $('.nav-tabs button').on('click', function (e) {
                var activeTab = $(e.target).attr('data-target').substr(1);
                sessionStorage.setItem('activeTab', activeTab);
            });
        });
    </script>
@endsection
