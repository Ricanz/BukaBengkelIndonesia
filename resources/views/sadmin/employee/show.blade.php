<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Karyawan</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="image-input image-input-outline" id="kt_image_1">
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}" >
                        <div class="image-input-wrapper"
                            style="background-image: url({{$employee->image}})"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title=""
                            data-original-title="Upload Image">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="file" accept=".png, .jpg, .jpeg, .heic" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">ID</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="code"
                                value="{{ $employee->code }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Nama Lengkap</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="fullname"
                                value="{{ $employee->fullname }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Cabang</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="client_id" id="client_id" class="form-control">
                                <option value="{{ $employee->client->id }}">{{ $employee->client->title }}</option>
                                @foreach(App\Models\Client::where('status', 'active')->get() as $client)
                                    <option value="{{ $client->id }}">{{ $client->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Kepala Bengkel</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="radio-inline">
                                <label class="radio">
                                <input type="radio" name="is_kabeng" value="true" {{ $employee->is_kabeng ? 'checked' : '' }}/>
                                <span></span>Ya</label>
                                <label class="radio">
                                <input type="radio" name="is_kabeng"  value="false" {{ !$employee->is_kabeng ? 'checked' : '' }}/>
                                <span></span>Tidak</label>
                                <label class="radio">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Email</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="email"
                                value="{{ $employee->user->email }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Password</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="password" class="form-control" name="password"
                                placeholder="Change User Password" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="status" id="status" class="form-control">
                                <option value="{{ $employee->status }}">{{ $employee->status }}</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="modal-footer">
                        <a href="{{ url('/employees?filter=employee') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/employee.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
