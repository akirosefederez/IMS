{{-- Create Modal --}}
<div class="modal fade" id="addCheckinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Check-in Item</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/checkins') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <select name="location" id="location" class="form-control" required>
                            <option value="" selected disabled>Select Location</option>
                            <option value="ORTIGAS">ORTIGAS</option>
                            <option value="A-JUAN">A-JUAN</option>
                            <option value="MARIKINA">MARIKINA</option>
                        </select>
                        @error('location')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="productSelector" class="form-label">Product (SKU - Description)</label>
                        <select name="sku" id="productSelector" class="form-control" required>
                            <option value="" selected disabled>Select a product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->sku }}"
                                data-category_id="{{ $product->category_id }}"
                                data-brand="{{ $product->brand }}"
                                data-productcode="{{ $product->productcode }}"
                                data-model="{{ $product->model }}"
                                data-description="{{ $product->description }}"
                                data-uom="{{ $product->uom }}">
                                {{ $product->sku }} - {{ $product->description }}
                            </option>
                            @endforeach
                        </select>
                        @error('sku')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" min="1" name="quantity" id="quantity" class="form-control" value="1" required />
                        @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Complete" selected>Complete</option>
                            <option value="Incomplete">Incomplete</option>
                            <option value="Defective">Defective</option>
                            <option value="Missing">Missing</option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" id="category_id" name="category_id" value="">
                    <input type="hidden" id="brand" name="brand" value="">
                    <input type="hidden" id="productcode" name="productcode" value="">
                    <input type="hidden" id="model" name="model" value="">
                    <input type="hidden" id="description" name="description" value="">
                    <input type="hidden" id="uom" name="uom" value="">

                    <input type="hidden" id="checkindate" name="checkindate" value="{{ \Carbon\Carbon::now()->toDateString() }}">

                    {{-- Removed PO No., STR No., Serial number, Remarks inputs as per simplification --}}

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productSelector = document.getElementById('productSelector');
        const categoryIdField = document.getElementById('category_id');
        const brandField = document.getElementById('brand');
        const productcodeField = document.getElementById('productcode');
        const modelField = document.getElementById('model');
        const descriptionField = document.getElementById('description');
        const uomField = document.getElementById('uom');

        productSelector.addEventListener('change', function (e) {
            const selectedOption = e.target.options[e.target.selectedIndex];

            categoryIdField.value = selectedOption.getAttribute('data-category_id') || '';
            brandField.value = selectedOption.getAttribute('data-brand') || '';
            productcodeField.value = selectedOption.getAttribute('data-productcode') || '';
            modelField.value = selectedOption.getAttribute('data-model') || '';
            descriptionField.value = selectedOption.getAttribute('data-description') || '';
            uomField.value = selectedOption.getAttribute('data-uom') || '';
        });
    });
</script>
