<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom mb-3">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Complete Checking (Post)</h3>
                </div>
                <div class="card-toolbar">
                    @if ($images< 12)
                        <a href="javascript:void()}" class="btn btn-danger font-weight-bolder mr-2">Foto minimal 12 untuk lihat dan download hasil check</a>
                    @else
                    <!--begin::Button-->
                        <a href="{{ route('download.complete_post', request()->segment(count(request()->segments()))) }}" target="blank"
                        class="btn btn-success font-weight-bolder mr-2">Download PDF</a>
                        <a href="{{ route('pdf.complete_post', request()->segment(count(request()->segments()))) }}"
                            target="blank" class="btn btn-warning font-weight-bolder mr-2 mb-2">Lihat Hasil</a>
                    <!--end::Button-->
                    @endif
                        @if (Auth::user()->role === 'employee')
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
                            </span>Tambah Foto</button>
                        <!--end::Button-->

                        <!-- Modal-->
                        <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Foto Checking</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" id="create_image_form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="checking_id" value="{{ $checking->id }}">
                                            <input type="hidden" name="type" value="post">
                                            <input type="hidden" name="checking_type" value="complete">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper"
                                                    style="background-image: url({{ asset('tadmin/media/users/100_1.jpg') }})">
                                                </div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
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
                                                <label class="col-form-label text-left col-lg-3 col-sm-12">Deskripsi
                                                    Foto</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <select name="description" id="description" class="form-control">
                                                        <option value="" selected>Pilih Deskripsi</option>
                                                        @foreach (App\Models\MasterChecking::where('type', 'complete')->where('status', 'active')->get() as $check)
                                                            <option value="{{ $check->id }}">
                                                                {{ $check->description }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-10"></div>
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

                        <div class="modal fade" id="editImage" data-backdrop="static" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Foto</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" id="update_image_form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="editId">
                                            <div class="image-input image-input-outline" id="kt_image_2">
                                                <div class="image-input-wrapper" id="checkImage" style="">
                                                </div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="file"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="profile_avatar_remove" />
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-form-label text-left col-lg-3 col-sm-12"
                                                            id="editLabel"></label>
                                                    </div>
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
                        @endif
                    </div>
            </div>
            <div class="card-body">
                <h6 class="card-label">{{ $checking->checking_type }} Checking</h6>
                <form class="form" id="create_checking_post_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="checking_id" id="checking_id" value="{{ $checking->id }}">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">No. Wo</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="wo" value="{{ $checking->wo }}"
                                disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">No. Polisi</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="nopol"
                                value="{{ $checking->plat_number }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Service Advisor</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="advisor" id="advisor" class="form-control" disabled>
                                <option value="{{ $checking->sa_id }}" selected>{{ $checking->advisor->name }}
                                </option>
                                @if (Auth::user()->role === 'employee')
                                    @foreach (App\Models\ServiceAdvisor::where('status', 'active')->where('client_id', Auth::user()->employee->client_id)->get() as $advisor)
                                        <option value="{{ $advisor->id }}">{{ $advisor->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Merek dan Tipe Kendaraan</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="type" id="type" class="form-control" disabled>
                                <option value="{{ $checking->type_id }}" selected>{{ $checking->types->name }}
                                </option>
                                @foreach (App\Models\MasterType::where('status', 'active')->get() as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h2>Hasil Post Check</h2>
                    <div id="form-container">
                        @for ($i = 0; $i < count($checking->complete); $i++)
                        <div class="form-group row check-group">
                            <input type="hidden" name="id[]" value="{{ $checking->complete[$i]->id }}">
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select name="master[]" id="master[]" class="form-control" disabled>
                                    <option value="{{ $checking->complete[$i]->master_checking_id }}" selected>{{ $checking->complete[$i]->master->name }}</option>
                                    {{-- @foreach (App\Models\MasterChecking::where('type', 'complete')->where('status', 'active')->get() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-8 mt-2">
                                <input type="text" class="form-control" name="hasil[]"
                                    placeholder="Cth: 261 Psi" value="{{ $checking->complete[$i]->val_check_post }}" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 mt-2">
                                <select name="hasil_check[]" id="hasil_check[]" class="form-control">
                                    <option value="{{ $checking->complete[$i]->pass_post ? 1 : 0 }}">{{ $checking->complete[$i]->pass_post ? "Lolos" : "Tidak Lolos" }}</option>
                                    <option value="1">Lolos</option>
                                    <option value="0" >Tidak Lolos</option>
                                </select>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                                <input type="text" class="form-control" name="judul_hasil[]"
                                    placeholder="Cth: Kompresor" value="{{ $checking->complete[$i]->value_title }}" disabled />
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                                    <input type="text" class="form-control" name="result[]"
                                        placeholder="Cth: Berfungsi Normal" value="{{ $checking->complete[$i]->value_post }}" />
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Saran Perbaikan</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="saran"
                                placeholder="Masukkan Saran Perbaikan" maxlength="75" value="{{ $checking->saran_post }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Catatan Pemeriksaan</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <textarea class="form-control" name="catatan" id="exampleTextarea" rows="3" maxlength="255">{{ $checking->note_post }}</textarea>
                        </div>
                    </div>
                    @if (Auth::user()->role === 'employee')
                        <div class="modal-footer">
                            <a href="{{ url('/checking/complete') }}" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary font-weight-bold">Save
                                changes</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="card card-custom">
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable" id="table_image"
                    data-id={{ $checking->id }}
                    data-type="post"
                    data-checkingType="complete">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('tadmin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{url('/custom/complete.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
