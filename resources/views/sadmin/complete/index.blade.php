<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Complete Checking</h3>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Complete Checking (Pre)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" id="create_checking_form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="checking_type" value="pre">
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
                                                        @foreach (App\Models\MasterType::where('status', 'active')->get() as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-10"></div>
                                            <h2>Hasil Pre Check</h2>
                                            <div id="form-container">
                                                <div class="form-group row check-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left p-0">
                                                        <div class="rounded-circle btn btn-sm btn-primary">1</div>
                                                        <strong>Standar Normal</strong>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                                                        <select name="master[]" id="master" onchange="selectMaster(event)" data-id="1" class="form-control">
                                                            <option value="" selected>Pilih Check</option>
                                                            @foreach (App\Models\MasterChecking::where('type', 'complete')->where('status', 'active')->get() as $type)
                                                                <option value="{{ $type->id }}">{{ $type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 p-2">
                                                        <input type="text" class="form-control" name="hasil[]"
                                                            placeholder="Cth: 261 Psi" />
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-4 p-2">
                                                        <select name="hasil_check[]" id="hasil_check[]" class="form-control">
                                                            <option value="1" selected>Lolos</option>
                                                            <option value="0" >Tidak Lolos</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left p-2">
                                                        <strong>Pre-Check</strong>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                                                        <select name="judul_hasil[]" id="judul_hasil-1" class="form-control" data-id="1" onchange="getItem(event)">
                                                            <option value="" selected>Pilih Checking</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                                                        <select name="result[]" id="result-1" class="form-control">
                                                            <option value="" selected>Pilih Item Checking</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 p-2 text-center">
                                                        <div class="cursor-pointer btn btn-danger ml-4 mt-2"  onclick="hapusCheck(event)">Hapus</div>
                                                        <div class="cursor-pointer btn btn-primary ml-4 mt-2" data-id="1" onclick="addChecking(event)">Tambah</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="separator separator-dashed my-10"></div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Saran Perbaikan</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" class="form-control" name="saran"
                                                        placeholder="Masukkan Saran Perbaikan" maxlength="75" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Catatan Pemeriksaan</label>
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
        <script src="{{url('/custom/complete.js')}}" type="application/javascript" ></script>
        <script>
            var count = 1;
            function getItem(e) {
                var judulId = e.target.value;
                var dataId = e.target.getAttribute('data-id');
                $.ajax({
                    url: '/get-results/' + judulId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#result-'+dataId).empty();
                        $.each(data, function (key, value) {
                            $('#result-'+dataId).append('<option value="' + value + '">' + value + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function selectMaster(e) {
                var masterId = e.target.value;
                var dataId = e.target.getAttribute('data-id');
                $.ajax({
                    url: '/select-master/' + masterId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (!data) {
                            swal.fire({
                                html: "Data tidak ditemukan, hubungi Admin!",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() { });
                        } else {
                            $('#judul_hasil-'+dataId).empty();
                            $('#judul_hasil-'+dataId).append('<option value="' + data.title + '">' + data.title + '</option>');
                            $('#result-'+dataId).empty();
                            $.each(data.item, function (key, value) {
                                $('#result-'+dataId).append('<option value="' + value + '">' + value + '</option>');
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function addChecking(e) {
                var dataId = e.target.getAttribute('data-id');
                count = parseInt(dataId) + 1;
                
                var clonedFormGroup = `
                <div class="form-group row check-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-left p-0">
                        <div class="rounded-circle btn btn-sm btn-primary">${count}</div>
                        <strong>Standar Normal</strong>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                        <select name="master[]" id="master" onchange="selectMaster(event)" data-id="${count}" class="form-control">
                            <option value="" selected>Pilih Check</option>
                            @foreach (App\Models\MasterChecking::where('type', 'complete')->where('status', 'active')->get() as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 p-2">
                        <input type="text" class="form-control" name="hasil[]"
                            placeholder="Cth: 261 Psi" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 p-2">
                        <select name="hasil_check[]" id="hasil_check[]" class="form-control">
                            <option value="1" selected>Lolos</option>
                            <option value="0" >Tidak Lolos</option>
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-left p-2">
                        <strong>Pre-Check</strong>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                        <select name="judul_hasil[]" id="judul_hasil-${count}" class="form-control" data-id="${count}" onchange="getItem(event)">
                            <option value="" selected>Pilih Checking</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                        <select name="result[]" id="result-${count}"  class="form-control">
                            <option value="" selected>Pilih Item Checking</option>
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 p-2 text-center">
                        <div class="cursor-pointer btn btn-danger ml-4 mt-2"  onclick="hapusCheck(event)">Hapus</div>
                        <div class="cursor-pointer btn btn-primary ml-4 mt-2" data-id="${count}" onclick="addChecking(event)">Tambah</div>
                    </div>
                </div>
                `;

                $("#form-container").append(clonedFormGroup);
                $("#form-container").find(".check-group:last input[type='text']").val(""); // Reset input value
            }

        </script>
    @endsection
</x-app-layout>
