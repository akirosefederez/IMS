

{{-- MODALS --}}
{{-- Generate PDF Modal --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">Generate Form</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <form method="POST" action="{{ url('admin/orders/generateForm') }}" enctype="multipart/form-data"
                id="form">
                <div class="modal-body">
                    <!-- form -->
                    @csrf
                    <div class="mb-3">
                        <label for="drnumber">DR No.</label>
                        <input type="text" name="drnumber" id="drnumber" type="text" class="form-control form-control-sm"
                            required placeholder="Enter DR No." value="{{ old('drnumber', '') }}" />
                        @error('drnumber')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generate PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Create MOdal --}}
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Deliver Items</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <form method="POST" id="forms">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <div class="form-row">
                            <div class="col">
                                <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                                <select name="location" id="location" class="form-control form-control-sm" required>
                                    <option value="" selected disabled>Select Location</option>
                                    <option value="ORTIGAS" {{ old('location') === 'ORTIGAS' ? 'selected' : '' }}>
                                        ORTIGAS</option>
                                    <option value="A-JUAN" {{ old('location') === 'A-JUAN' ? 'selected' : '' }}>A-JUAN
                                    </option>
                                    <option value="MARIKINA" {{ old('location') === 'MARIKINA' ? 'selected' : '' }}>
                                        MARIKINA</option>
                                </select>
                                @error('location')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="checkoutdate">Checkout date</label>
                                <input type="date" required name="checkoutdate" id="checkoutdate"
                                    class="form-control form-control-sm" value="{{ old('checkoutdate', '') }}" />
                                @error('checkoutdate')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="srnumber">SR No.</label>
                                <input type="text" required name="srnumber" id="srnumber" class="form-control form-control-sm"
                                    value="{{ old('srnumber', '') }}" placeholder="Enter SR no." />
                                @error('srnumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="ponumber">PO No.</label>
                                <input type="text" required name="ponumber" id="ponumber" class="form-control form-control-sm"
                                    value="{{ old('ponumber', '') }}" placeholder="Enter PO no." />
                                @error('ponumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="form-row">
                            <div class="col">
                                <label for="client">Client</label>
                                <input type="text" required name="client" id="client" class="form-control form-control-sm"
                                    value="{{ old('client', '') }}" placeholder="Enter client name" />
                                @error('client')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="contact">Contact Person</label>
                                <input type="text" required name="contact" id="contact" class="form-control form-control-sm"
                                    value="{{ old('contact', '') }}" placeholder="Enter contact person" />
                                @error('contact')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="site">Site/Event</label>
                                <input type="text" required name="site" id="site" class="form-control form-control-sm"
                                    value="{{ old('site', '') }}" placeholder="Enter site/event" />
                                @error('site')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="form-row">
                            <div class="col">
                                <label for="address">Address</label>
                                <input type="text" required name="address" id="address" class="form-control form-control-sm"
                                    value="{{ old('address', '') }}" placeholder="Enter address" />
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dynamicTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>SKU</th>
                                        <th style="width:20%">Item Quantity</th>
                                        <th>Serial No.</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>
                                        <input type="text" name="addmore[0][sku]" placeholder="SKU"
                                            class="form-control form-control-sm" />
                                    </td>

                                    <td><input type="number" min="1" name="addmore[0][quantity]" placeholder="Quantity"
                                            class="form-control form-control-sm" /></td>

                                    <td>
                                        <textarea name="addmore[0][serialnumber]" class="form-control form-control-sm" cols="15" rows="1"
                                            placeholder="Serial no."></textarea>
                                    </td>

                                    <td class="border border-white"><button type="button" name="add"
                                            id="add" class="btn btn-success btn-sm"
                                            style="background-color: #4D83FF; color: white;  border-color: #4D83FF;"><i
                                                class="bi bi-plus-circle"></i></button></td>

                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitButt" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

