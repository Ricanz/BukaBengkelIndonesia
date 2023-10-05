<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Teknisi</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_access_form" enctype="multipart/form-data">
                    @csrf
                    <div class="image-input image-input-outline" id="kt_image_1">
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}" >
                        <div class="image-input-wrapper"
                            style="background-image: url({{$employee->image}})"></div>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Nama Lengkap</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="fullname"
                                value="{{ $employee->fullname }}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Cabang</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="client_id" id="client_id" class="form-control">
                                <option value="{{ $employee->client->id }}">{{ $employee->client->title }}</option>
                                @if (Auth::user()->role === 'client')
                                    @foreach(App\Models\Client::where('status', 'active')->where('kabeng_id', Auth::user()->id)->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->title }}</option>
                                    @endforeach
                                @elseif (Auth::user()->role === 'admin')
                                    @foreach(App\Models\Client::where('status', 'active')->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="modal-footer">
                        <a href="{{ url('/access') }}" class="btn btn-light-primary font-weight-bold">Back</a>
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
