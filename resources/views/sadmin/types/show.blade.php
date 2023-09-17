<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Merk & Type</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_type_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_id" value="{{ $type->id }}" >
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Code</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="code"
                                value="{{ $type->code }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Merk & Type</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="name"
                                value="{{ $type->name }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="status" id="status" class="form-control">
                                <option value="{{ $type->status }}">{{ $type->status }}</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="modal-footer">
                        <a href="{{ url('/types') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/type.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
