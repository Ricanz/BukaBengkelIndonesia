<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Service Advisor</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
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
                        </span>Tambah SA</button>
                    <!--end::Button-->

                    <!-- Modal-->
                    <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog"
                        aria-labelledby="staticBackdrop" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah SA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" id="create_advisor_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-3 col-sm-12">Nama
                                                Lengkap</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Masukkan Nama Service Advisor" />
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
                                            <a href="{{ url('/advisor') }}"
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
                <table class="table table-bordered table-hover table-checkable" id="table_advisor">
                    <thead>
                        <tr>
                            <th>Bengkel</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
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
        <script src="{{url('/custom/advisor.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
