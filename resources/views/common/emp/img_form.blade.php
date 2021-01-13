<div class="row py-4">
    <div class="col-lg-6 mx-auto">
        <div class="image-area mt-4">
            <img id="imageResult" src="{{ asset('storage/img/employee/'.$employee->emp_image) }}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
        </div>
        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm upload-button">
            <input id="upload" type="file" value="{{old('emp_image') }}" name="emp_image" onchange="readURL(this);" class="form-control border-0">
            <input type="hidden" name="emp_image_old" value="{{old('emp_image', ($employee->emp_image ?? '')) }}" readonly>
            <label id="upload-label" class="font-weight-light text-muted">Choose File</label>
            <div class="input-group-append upload-container">
                <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
                    <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                    <small class="text-uppercase font-weight-bold text-muted">Choose File</small>
                </label>
            </div>
        </div>
        @error('emp_image')
            <span class="error" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>