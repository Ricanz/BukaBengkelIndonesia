<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Detail Service Advisor</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_advisor_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $advisor->id }}">
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Nama Lengkap</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="name"
                                value="{{ $advisor->name }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Cabang</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="cabang" id="cabang" class="form-control">
                                <option value="{{ $advisor->client->id }}">{{ $advisor->client->title }}</option>
                                @if (Auth::user()->role === 'client')
                                    @foreach(App\Models\Client::where('status', 'active')->where('kabeng_id', Auth::user()->id)->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->title }}</option>
                                    @endforeach
                                @elseif(Auth::user()->role === 'admin')
                                    @foreach(App\Models\Client::where('status', 'active')->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="status" id="status" class="form-control">
                                <option value="{{ $advisor->status }}">{{ $advisor->status }}</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="modal-footer">
                        <a href="{{ url('/clients') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/advisor.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
