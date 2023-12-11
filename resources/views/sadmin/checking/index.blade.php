<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Checking</h3>
                </div>
                @if (Auth::user()->role === 'employee')
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
                            </span>Tambah Data</button>
                        <!--end::Button-->

                        <!-- Modal-->
                        <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Standart Checking (Pre)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" id="create_checking_form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="type" value="pre">
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">No.
                                                    Wo</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="wo"
                                                        placeholder="Masukkan Nomor Wo"
                                                        value="{{ App\Helpers\Utils::generateWo() }}" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">No.
                                                    Polisi</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="nopol"
                                                        placeholder="Masukkan No. Polisi Kendaraan" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Service
                                                    Advisor</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="advisor" id="advisor" class="form-control">
                                                        <option value="" selected>Pilih Service Advisor</option>
                                                        @foreach (App\Models\ServiceAdvisor::where('status', 'active')->where('client_id', Auth::user()->employee->client_id)->orderBy('name')->get() as $advisor)
                                                            <option value="{{ $advisor->id }}">{{ $advisor->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Merek dan
                                                    Tipe Kendaraan</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="" selected>Pilih Tipe</option>
                                                        @foreach (App\Models\MasterType::where('status', 'active')->orderBy('name')->get() as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-10"></div>
                                            <h2>Hasil Pre Check</h2>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Kilometer
                                                    Kendaraan</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="km"
                                                        placeholder="Masukkan Kilometer Kendaraan" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">High Pressure
                                                    (199.1 Psi - 227.5 Psi)</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="high"
                                                        placeholder="Masukkan High Pressure Kendaraan" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Low Pressure
                                                    (21.3 Psi - 35.5 Psi)</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="low"
                                                        placeholder="Masukkan Low Pressure Kendaraan" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Suhu Blower
                                                    (4 °C - 8 °C)</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="suhu"
                                                        placeholder="Masukkan Suhu Blower Kendaraan" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Wind Speed
                                                    (2.5 m/s - 4 m/s)</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="wind"
                                                        placeholder="Masukkan Wind Speed Kendaraan" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'compressor')->where('type', 'standart')->pluck('item')->first())}}:</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="compressor" id="compressor" class="form-control">
                                                        @foreach(explode(',', App\Models\MasterItem::where('slug', 'compressor')->where('type', 'standart')->pluck('checklist')->first()) as $client)
                                                            <option value="{{ $client }}">{{ $client }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'cabin-air-filter')->where('type', 'standart')->pluck('item')->first())}}:</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="cabin" id="cabin" class="form-control">
                                                        @foreach(explode(',', App\Models\MasterItem::where('slug', 'cabin-air-filter')->where('type', 'standart')->pluck('checklist')->first()) as $client)
                                                            <option value="{{ $client }}">{{ $client }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'blower')->where('type', 'standart')->pluck('item')->first())}}:</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="blower" id="blower" class="form-control">
                                                        @foreach(explode(',', App\Models\MasterItem::where('slug', 'blower')->where('type', 'standart')->pluck('checklist')->first()) as $client)
                                                            <option value="{{ $client }}">{{ $client }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'motor-fan')->where('type', 'standart')->pluck('item')->first())}}:
                                                </label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="fan" id="fan" class="form-control">
                                                        @foreach(explode(',', App\Models\MasterItem::where('slug', 'motor-fan')->where('type', 'standart')->pluck('checklist')->first()) as $client)
                                                            <option value="{{ $client }}">{{ $client }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Saran
                                                    Perbaikan</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <textarea class="form-control" name="saran" id="exampleTextarea" rows="3" maxlength="75"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Catatan
                                                    Pemeriksaan</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <textarea class="form-control" name="catatan" id="exampleTextarea" rows="3" maxlength="255"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li
                                        class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                        Choose an option:</li>
                                    <li class="navi-item">
                                    <li class="navi-item">
                                        <a href="{{ route('checking.download') }}" target="blank" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-text-o"></i>
                                            </span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                    </div>
                @endif
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>No. Polisi</th>
                            <th>No. WO</th>
                            <th>Tipe</th>
                            <th>Teknisi</th>
                            <th>SA</th>
                            <th>Kendaraan</th>
                            <th>Post Check</th>
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
        <script src="{{url('/custom/checking.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
