<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">User Profile</h3>
            </div>
            </div>
            @if (Auth::user()->role === 'admin')
                <div class="card-body">
                    <form class="form" id="update_user_profile_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label text-left col-lg-3 col-sm-12">Nama Lengkap</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="fullname"
                                    value="{{ Auth::user()->name }}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-left col-lg-3 col-sm-12">Email</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="email"
                                    value="{{ Auth::user()->email }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-left col-lg-3 col-sm-12">Password</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Change User Password" />
                            </div>
                        </div>
                        <div class="separator separator-dashed my-10"></div>
                        <div class="modal-footer">
                            <a href="{{ url('/dashboard') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                            <button type="submit" class="btn btn-primary font-weight-bold">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="card-body">
                    <form class="form" id="update_user_profile_form" enctype="multipart/form-data">
                        @csrf
                        <div class="image-input image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper"
                                style="background-image: url({{$employee->image}})"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
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
                            <label class="col-form-label text-left col-lg-3 col-sm-12">Nama Lengkap</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="fullname"
                                    value="{{ $employee->fullname }}"/>
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
                        <div class="separator separator-dashed my-10"></div>
                        <div class="modal-footer">
                            <a href="{{ url('/dashboard') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                            <button type="submit" class="btn btn-primary font-weight-bold">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/employee.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
