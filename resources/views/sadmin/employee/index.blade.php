<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Users</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    @if (request('filter') === 'client')
                        <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Tambah Admin</button>
                    @elseif (request('filter') === 'employee')
                        <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Tambah Teknisi</button>
                    @endif

                    <!-- Modal-->
                    <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog"
                        aria-labelledby="staticBackdrop" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" id="create_employee_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="image-input image-input-outline" id="kt_image_1">
                                            <div class="image-input-wrapper" style="background-image: url({{ asset('tadmin/media/users/image_upload_fix.png') }})"></div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Upload Image">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="file" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="profile_avatar_remove" />
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">ID</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input type="text" class="form-control" name="id"
                                                    placeholder="Masukkan ID Karyawan" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">Nama
                                                Lengkap</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Masukkan Nama Karyawan" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">Cabang</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <select name="cabang" id="cabang" class="form-control">
                                                    <option value="" selected>
                                                        Pilih Cabang</option>
                                                        @if (Auth::user()->role === 'admin')
                                                            @foreach (App\Models\Client::where('status', 'active')->get() as $client)
                                                                <option value="{{ $client->id }}">{{ $client->title }}
                                                                </option>
                                                            @endforeach
                                                        @elseif (Auth::user()->role === 'client')
                                                            @foreach (App\Models\Client::where('status', 'active')->where('kabeng_id', Auth::user()->id)->get() as $client)
                                                                <option value="{{ $client->id }}">{{ $client->title }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">Email</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input type="text" class="form-control" name="email"
                                                    placeholder="Masukkan Email Karyawan" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">Password</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Masukkan Password Karyawan" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed my-10"></div>
                                        <div class="modal-footer">
                                            <a href="{{ url('/clients') }}"
                                                class="btn btn-light-primary font-weight-bold">Back</a>
                                            <button type="submit" class="btn btn-primary font-weight-bold">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                @if (app('request')->input('filter'))
                    <table class="table table-bordered table-hover table-checkable" id="table_employee">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Cabang</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                @else
                    <table class="table table-bordered table-hover table-checkable" id="table_admin">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                @endif
                <!--end: Datatable-->
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <a class="btn btn-danger" id="confirmDelete" href="#">Ya, Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    @section('scripts')
        <script src="{{ asset('tadmin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{url('/custom/employee.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
