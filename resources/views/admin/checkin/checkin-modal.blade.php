{{-- Create Modal --}}
<div class="modal fade" id="addCheckinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Check-in Item/s</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/checkins') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                <label for="checkindate">Checkin date</label>
                                <input type="date" required name="checkindate" id="checkindate"
                                    class="form-control" value="{{ old('checkindate', '') }}" required/>
                            </div>
                            <div class="col">
                                <label>PO No.</label>
                                <input type="text" name="ponumber" class="form-control" required placeholder="Enter PO no." />
                            </div>
                            <div class="col">
                                <label>STR No.</label>
                                <input type="text" name="strnumber" class="form-control" required placeholder="Enter STR no."/>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">

                            <div class="col">
                                <label>SKU</label>
                                <input type="text" name="sku" class="form-control" required placeholder="Enter SKU" />
                            </div>

                            <div class="col">
                                <label>Serial No.</label>
                                <textarea rows="1" name="serialnumber" class="form-control" placeholder="Serial no."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Quantity</label>
                                <input type="number" min="1" name="quantity" class="form-control" required placeholder="Enter quantity"/>
                            </div>

                            <div class="col">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="" selected>Select status</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Incomplete">Incomplete</option>
                                    <option value="Incomplete">Defective</option>
                                    <option value="Incomplete">Missing</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Remarks</label>
                                <textarea type="text" name="remarks" class="form-control" rows="4" placeholder="Enter remarks"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="py-2 float-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#categoryList').on('change', function () {
    $("#brandsList").attr('disabled', false); //enable brands select
    $("#brandsList").val("");
    $(".brands").attr('disabled', true); //disable all category option
    $(".brands").hide(); //hide all brands option
    $(".parent-" + $(this).val()).attr('disabled', false); //enable brands of selected category/parent
    $(".parent-" + $(this).val()).show();
});
</script>
