<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Master Data Item Checking</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_item_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Item</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="item"
                                value="{{ $data->item }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Checklist</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="checklist"
                                value="{{ $data->checklist }}"/>
                            <span class="form-text text-muted">Contoh: Berfungsi Normal, Bocor, Berisik</span>
                            <span class="form-text text-muted">pisahkan dengan koma ( , )</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Tipe</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="type" id="type" class="form-control">
                                <option value="{{ $data->type }}">{{ ucwords($data->type) }}</option>
                                <option value="complete">Complete</option>
                                <option value="standart">Standart</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="status" id="status" class="form-control">
                                <option value="{{ $data->status }}">{{ $data->status }}</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="modal-footer">
                        <a href="{{ url('/master/item') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/item.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
