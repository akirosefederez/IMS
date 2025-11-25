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
            <form method="POST" action="{{ url('manager/purchasereturns/generateForm') }}"
                enctype="multipart/form-data" id="form">
                <div class="modal-body">
                    <!-- form -->
                    @csrf
                    <div class="mb-3">
                        <label for="drnumber">DR No.</label>
                        <input type="text" name="drnumber" id="drnumber" type="text" class="form-control"
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
                <h3 class="modal-title" id="exampleModalLabel">Return Items</h3>
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
                                    <option value="ORTIGAS">ORTIGAS</option>
                                    <option value="A-JUAN">A-JUAN</option>
                                    <option value="MARIKINA">MARIKINA</option>
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
                                <label for="prsnumber">PRS No.</label>
                                <input type="text" required name="prsnumber" id="prsnumber" class="form-control form-control-sm"
                                    value="{{ old('prsnumber', '') }}" placeholder="Enter PRS No." />
                                @error('prsnumber')
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
                                <label for="site">Site/Event</label>
                                <input type="text" required name="site" id="site" class="form-control form-control-sm"
                                    value="{{ old('site', '') }}" placeholder="Enter site/event" />
                                @error('site')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="col">
                                <label for="drnumber">DR No.</label>
                                <input type="text" required name="drnumber" id="drnumber" class="form-control form-control-sm"
                                    value="{{ old('drnumber', '') }}" placeholder="Enter DR no." />
                                @error('drnumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}



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

                    <div class="mb-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="dynamicTable">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>SKU</th>
                                        <th style="width:20%">Quantity</th>
                                        <th>Serial No.</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>
                                        <input type="text" name="addmore[0][sku]" placeholder="SKU"
                                            class="form-control form-control-sm" />
                                    </td>

                                    <td><input type="number" name="addmore[0][quantity]" placeholder="Quantity"
                                           min="1" class="form-control form-control-sm" /></td>

                                    <td>
                                        <textarea name="addmore[0][serialnumber]" placeholder="Serial No." class="form-control form-control-sm" rows="1"></textarea>
                                    </td>

                                    <td class="border border-white"><button type="button" name="add"
                                            id="add" class="btn btn-success btn-sm"
                                            style="background-color: #4D83FF; color: white;  border-color: #4D83FF;"><i
                                                class="bi bi-plus-circle"></i></button></td>



                                </tr>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        Please fill out all of the table fields.
                                    </div>
                                @endif
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

{{-- Edit Modal --}}
{{-- <div class="modal fade" id="updateCheckoutModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Checkout Items</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
                <div class="modal-body">
                    <form action="{{ url('manager/orders/'.$order_item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
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

                            <div class="col">
                                <label for="checkoutdate">Checkout date</label>
                                <input type="date" required name="checkoutdate" id="checkoutdate"
                                    class="form-control" value="{{ old('checkoutdate', '') }}" />
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
                                <input type="text" required name="client" id="client" class="form-control"
                                    value="{{ old('client', '') }}" placeholder="Enter client name" />
                                @error('client')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="stonumber">STO No.</label>
                                <input type="text" required name="stonumber" id="stonumber" class="form-control"
                                    value="{{ old('stonumber', '') }}" placeholder="Enter STO no." />
                                @error('stonumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="srfnumber">SRF No.</label>
                                <input type="text" required name="srfnumber" id="srfnumber" class="form-control"
                                    value="{{ old('srfnumber', '') }}" placeholder="Enter SRF no." />
                                @error('srfnumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </form>
        </div>
    </div>
</div> --}}


{{-- Delete Modal --}}

@push('script')
    {{-- <script>
        window.addEventListener('close-modal', event => {
            $('#addOrderModal').modal('hide');
        });
    </script>
    <script>
        $("#forms").submit(function(e) {
            e.preventDefault();
            {{ url('manager/orders') }};
        });
    </script> --}}
@endpush
