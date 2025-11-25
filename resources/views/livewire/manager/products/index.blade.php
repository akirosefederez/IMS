<div class="row">
    @section('title', 'Inventory')
    @include('livewire.manager.products.modal-form')
    <div class="col-md-12">
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
        <div class="card mb-5">
            <div class="card-header">
                <h3>INVENTORY
                    <a class="btn btn-info btn-sm shadow-none float-right mx-1" href="{{ route('products.export') }}">Export Excel File</a>

                    <a href="{{ url('manager/products/productsPDF') }}"
                        class="btn btn-danger btn-sm shadow-none float-right mx-1">Export to PDF</a>
                    <a href="#" class="btn btn-primary btn-sm shadow-none float-right mx-1" data-toggle="modal"
                        data-target="#addInventoryModal">Add Item</a>
                    {{-- <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-right">Add Product</a> --}}
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{ route('products.search2') }}" method="GET" role="search">
                        <div class="form-row float-right mb-2 mr-1">
                            <div class="input-group" style="max-width:18rem;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="submit" title="Search Products"
                                        id="button-addon1"><i class="fas fa-search"></i></button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search Products" name="term"
                                    id="term" aria-label="Search field" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <a class="btn btn-danger" type="button" title="Refresh page"
                                        href="{{ url('manager/products') }}"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'ajuan' ? 'active show' : '' }}" wire:click="switchTab('ajuan')" id="ajuan-tab" data-toggle="tab" data-target="#ajuan"
                                type="button" role="tab" aria-controls="available" aria-selected="false"
                                wire:ignore>A-JUAN</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'marikina' ? 'active show' : '' }}" wire:click="switchTab('marikina')" id="marikina-tab" data-toggle="tab" data-target="#marikina"
                                type="button" role="tab" aria-controls="lowstock" aria-selected="false"
                                wire:ignore>MARIKINA</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'ortigas' ? 'active show' : '' }}" wire:click="switchTab('ortigas')" id="ortigas-tab" data-toggle="tab" data-target="#ortigas"
                                type="button" role="tab" aria-controls="outofstock" aria-selected="false"
                                wire:ignore>ORTIGAS</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade {{ $activeTab === 'ajuan' ? 'show active' : '' }}" id="ajuan" role="tabpanel" aria-labelledby="ajuan-tab" wire:ignore.self>
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered table-hover table-sm">
                                    <thead class="table-dark">
                                        <tr class="text-nowrap">
                                            <th class="text-center align-middle">ID</th>
                                            <th class="text-center align-middle">Location</th>
                                            <th class="text-center align-middle">Date Received</th>
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
                                                    <td class="text-nowrap">{{ $product->created_at }}</td>
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
                                                    <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">{{ $product->description }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>
                                                        @if ($product->quantity === 0)
                                                            <label class="badge badge-danger"
                                                                title="This item is unavailable">Out of
                                                                Stock</label>
                                                        @elseif($product->quantity <= 20)
                                                            <label class="badge rounded btn-warning"
                                                                title="This item is almost out of stock">Low
                                                                Stock</label>
                                                        @else
                                                            <label class="badge rounded btn-success"
                                                                title="This item is available">Available</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <a href="#"
                                                            wire:click="editProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#viewProductModal"
                                                            class="btn btn-primary shadow-none btn-sm"
                                                            title="View item">
                                                            <i class="bi bi-eye"></i>
                                                        </a>

                                                        <a href="#"
                                                            wire:click="editProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#updateProductModal"
                                                            class="btn btn-warning shadow-none btn-sm"
                                                            title="Update item">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="#"
                                                            wire:click="deleteProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            class="btn btn-danger shadow-none btn-sm"
                                                            title="Delete item">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                        @empty
                                            <tr>
                                                <td colspan="14">No Items Available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $ajuan_products->links() }}
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab === 'marikina' ? 'show active' : '' }}" id="marikina" role="tabpanel" aria-labelledby="marikina-tab" wire:ignore.self>
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered table-hover table-sm">
                                    <thead class="table-dark">
                                        <tr class="text-nowrap">
                                            <th class="text-center align-middle">ID</th>
                                            <th class="text-center align-middle">Location</th>
                                            <th class="text-center align-middle">Date Received</th>
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
                                                    <td class="text-nowrap">{{ $product->created_at }}</td>
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
                                                    <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">{{ $product->description }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>
                                                        @if ($product->quantity === 0)
                                                            <label class="badge badge-danger"
                                                                title="This item is unavailable">Out of
                                                                Stock</label>
                                                        @elseif($product->quantity <= 20)
                                                            <label class="badge rounded btn-warning"
                                                                title="This item is almost out of stock">Low
                                                                Stock</label>
                                                        @else
                                                            <label class="badge rounded btn-success"
                                                                title="This item is available">Available</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <a href="#"
                                                            wire:click="editProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#viewProductModal"
                                                            class="btn btn-primary shadow-none btn-sm"
                                                            title="View item">
                                                            <i class="bi bi-eye"></i>
                                                        </a>

                                                        <a href="#"
                                                            wire:click="editProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#updateProductModal"
                                                            class="btn btn-warning shadow-none btn-sm"
                                                            title="Update item">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="#"
                                                            wire:click="deleteProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            class="btn btn-danger shadow-none btn-sm"
                                                            title="Delete item">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                        @empty
                                            <tr>
                                                <td colspan="14">No Items Available</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                                {{ $marikina_products->links() }}
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab === 'ortigas' ? 'show active' : '' }}" id="ortigas" role="tabpanel" aria-labelledby="ortigas-tab" wire:ignore.self>
                            <div class="table-responsive mb-3">
                                <table class="table table-striped table-bordered table-hover table-sm">
                                    <thead class="table-dark">
                                        <tr class="text-nowrap">
                                            <th class="text-center align-middle">ID</th>
                                            <th class="text-center align-middle">Location</th>
                                            <th class="text-center align-middle">Date Received</th>
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
                                                    <td class="text-nowrap">{{ $product->created_at }}</td>
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
                                                    <td style="word-wrap: break-word;min-width: 350px;max-width: 350px;">{{ $product->description }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>
                                                        @if ($product->quantity === 0)
                                                            <label class="badge badge-danger"
                                                                title="This item is unavailable">Out of
                                                                Stock</label>
                                                        @elseif($product->quantity <= 20)
                                                            <label class="badge rounded btn-warning"
                                                                title="This item is almost out of stock">Low
                                                                Stock</label>
                                                        @else
                                                            <label class="badge rounded btn-success"
                                                                title="This item is available">Available</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <a href="#"
                                                            wire:click="editProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#viewProductModal"
                                                            class="btn btn-primary shadow-none btn-sm"
                                                            title="View item">
                                                            <i class="bi bi-eye"></i>
                                                        </a>

                                                        <a href="#"
                                                            wire:click="editProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#updateProductModal"
                                                            class="btn btn-warning shadow-none btn-sm"
                                                            title="Update item">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="#"
                                                            wire:click="deleteProduct({{ $product->id }})"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            class="btn btn-danger shadow-none btn-sm"
                                                            title="Delete item">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                        @empty
                                            <tr>
                                                <td colspan="14">No Items Available</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                                {{ $ortigas_products->links() }}
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addInventoryModal').modal('hide');
            $('#updateProductModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
