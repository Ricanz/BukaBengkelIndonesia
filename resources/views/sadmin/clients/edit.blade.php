<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Cabang</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{ url('client/employee', $client->id) }}" class="btn btn-primary font-weight-bolder">
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
                        </span>Daftar Teknisi</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_client_form" enctype="multipart/form-data">
                    @csrf
                    <div class="image-input image-input-outline" id="kt_image_1">
                        <input type="hidden" name="client_id" value="{{ $client->id }}" >
                        <div class="image-input-wrapper"
                            style="background-image: url({{$client->image}})"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title=""
                            data-original-title="Upload Image">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="file" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Kabeng</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <a href="{{ route('employee.show', $kabeng->id) }}" class="form-control">{{ $kabeng->fullname }}</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">ID</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="id"
                                value="{{ $client->code }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Cabang</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="name"
                            value="{{ $client->title }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Total Begkel</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="count"
                            value="{{ $count }}" disabled />
                        </div>
                    </div>
                    @if (Auth::user()->role === 'admin')
                        <div class="form-group row">
                            <label class="col-form-label text-left col-lg-3 col-sm-12">Kuota</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="quota"
                                value="{{ $quota }}" />
                            </div>
                        </div>
                    @elseif (Auth::user()->role === 'client')
                        <div class="form-group row">
                            <label class="col-form-label text-left col-lg-3 col-sm-12">Kuota</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="quota"
                                value="{{ $quota }}" disabled/>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Tanggal Kadaluwarsa {{ $expired_at }}</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="date" class="form-control" name="expired_at"
                            value="{{ $client->expired_at }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Alamat</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="address"
                                value="{{ $client->address }}" />
                            {{-- <span class="form-text text-muted">Informasi nama cabang</span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Kota</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="city"
                                value="{{ $client->city }}" />
                            {{-- <span class="form-text text-muted">Informasi nama cabang</span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="status" id="status" class="form-control">
                                <option value="{{ $client->status }}">{{ $client->status }}</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Deskripsi</label>
                        <textarea name="description" id="description" hidden></textarea>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="summernote" id="kt_summernote_1">{!! $client->description !!}</div>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/clients') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                    <button type="submit" class="btn btn-primary font-weight-bold">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('tadmin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{url('/custom/client.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
