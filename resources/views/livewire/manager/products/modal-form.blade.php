{{-- Add Inventory Modal --}}
<div wire:ignore.self class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add Item</h3>
                <a wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-circle"></i></a>
            </div>
            <form wire:submit.prevent="storeInventory">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Location</label>
                        <select wire:model.defer="location" class="form-control" required>
                            <option value="">Select location</option>
                            <option value="ORTIGAS">ORTIGAS</option>
                            <option value="A-JUAN">A-JUAN</option>
                            <option value="MARIKINA">MARIKINA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Category</label>
                                <select wire:model="category_id" class="form-control" required>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Brand</label>
                                <select wire:model="brand" class="form-control" required>
                                    <option value="">Select brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Model</label>
                                <input type="text" wire:model.defer="model" class="form-control" placeholder="Enter model" required />
                            </div>
                            <div class="col">
                                <label>SKU</label>
                                <input type="text" wire:model.defer="sku" class="form-control" placeholder="Enter SKU" required/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Product Code</label>
                                <input type="text" wire:model.defer="productcode" class="form-control" placeholder="Enter product code" required/>
                            </div>
                            <div class="col">
                                <label>UOM</label>

                                <select wire:model.defer="uom" class="form-control" required>
                                    <option value="">Select UOM</option>
                                    <option value="UNIT/S">UNIT/S</option>
                                    <option value="PANEL/S">PANEL/S</option>
                                    <option value="PC/S">PC/S</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Quantity</label>
                                <input type="number" min="1" wire:model.defer="quantity" class="form-control" placeholder="Enter quantity"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Item Description</label>
                        <textarea wire:model.defer="description" class="form-control" rows="4" placeholder="Enter item description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-sm btn-secondary"
                        data-dismiss="modal">Cancel</button>
                    <div class="py-2 float-end">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h3>
                <a class="btn-close" class="btn" data-dismiss="modal" aria-label="Close"></a>
            </div>
            <form wire:submit.prevent="destroyProduct">
                <div class="modal-body">
                    <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                    <h6>Are you sure you want to delete this item and its data?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Yes. Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Brand Modal -->
<div wire:ignore.self class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h3>
                <a type="button" wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-circle"></i></a>
            </div>
            <form wire:submit.prevent="updateProduct">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Location</label>
                        <select wire:model="location" class="form-control" required>
                            <option value="">Select location</option>
                            <option value="ORTIGAS">ORTIGAS</option>
                            <option value="A-JUAN">A-JUAN</option>
                            <option value="MARIKINA">MARIKINA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Select Category</label>
                                <select wire:model="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Select Brand</label>
                                <select wire:model="brand" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Model</label>
                                <input type="text" wire:model="model" class="form-control" />
                            </div>
                            <div class="col">
                                <label>SKU</label>
                                <input type="text" wire:model="sku" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Product Code</label>
                                <input type="text" wire:model="productcode" class="form-control" />
                            </div>
                            <div class="col">
                                <label>UOM</label>
                                <select wire:model="uom" class="form-control" required>
                                    <option value="">Select UOM</option>
                                    <option value="Units">UNIT/S</option>
                                    <option value="Panels">PANEL/S</option>
                                    <option value="Pcs">PC/S</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Quantity</label>
                                <input type="number" min="1" wire:model="quantity"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea wire:model="description" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-sm btn-secondary"
                        data-dismiss="modal">Cancel</button>
                    <div class="py-2 float-end">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- View Modal --}}
<div wire:ignore.self class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Product Details</h3>
                <a type="button" wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-circle"></i></a>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="staticLocation" class="col-form-label">Location</label>
                                <input type="text" readonly class="form-control" id="staticLocation"
                                    wire:model.defer="location">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Category</label>
                                <select wire:model.defer="category_id" class="form-control" disabled>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Brand</label>
                                <select wire:model.defer="brand" class="form-control" disabled>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Model</label>
                                <input type="text" wire:model.defer="model" class="form-control" disabled />
                            </div>
                            <div class="col">
                                <label>SKU</label>
                                <input type="text" wire:model.defer="sku" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Product Code</label>
                                <input type="text" wire:model.defer="productcode" class="form-control" disabled />
                            </div>
                            <div class="col">
                                <label>UOM</label>
                                <input type="text" wire:model.defer="uom" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Quantity</label>
                                <input type="number" min="1" wire:model.defer="quantity"
                                    class="form-control" disabled />
                            </div>
                            <div class="col">
                                <label>Status</label>
                                <input type="text" name="status" class="form-control"
                                    value="{{ $currentStatus }}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea wire:model.defer="description" class="form-control" rows="6" disabled></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-sm btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
