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
                        @if (count($checking->complete_posts) > 0)
                            @for ($i = 0; $i < count($checking->complete_posts); $i++)
                            <div class="form-group row check-group">
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <select name="master[]" id="master[]" class="form-control">
                                        <option value="{{ $checking->complete_posts[$i]->master_checking_id }}" selected>{{ $checking->complete_posts[$i]->master->name }}</option>
                                        @foreach (App\Models\MasterChecking::where('type', 'complete')->where('status', 'active')->get() as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                                    <input type="text" class="form-control" name="judul_hasil[]"
                                        placeholder="Cth: Kompresor" value="{{ $checking->complete_posts[$i]->value_title }}" />
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                                        <input type="text" class="form-control" name="result[]"
                                            placeholder="Cth: Berfungsi Normal" value="{{ $checking->complete_posts[$i]->value }}" />
                                    </div>
                                </div>
                            @endfor
                        @else
                            <div class="form-group row check-group">
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <select name="master[]" id="master[]" class="form-control">
                                        <option value="" selected>Pilih Check</option>
                                        @foreach (App\Models\MasterChecking::where('type', 'complete')->where('status', 'active')->get() as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                                    <input type="text" class="form-control" name="judul_hasil[]"
                                        placeholder="Cth: Kompresor" />
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                                    <input type="text" class="form-control" name="result[]"
                                        placeholder="Cth: Berfungsi Normal" />
                                </div>
                            </div>
                        @endif
                    </div>
                    <a href="#" id="addCheckButton">Tambah Check</a>
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
    </div>
    @section('scripts')
        <script src="{{ asset('tadmin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{url('/custom/complete.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
