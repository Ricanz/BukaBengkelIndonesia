<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom mb-3">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Standart Checking (Post)</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="create_checking_post_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $check->id }}">
                    <input type="hidden" name="type_check" value="post">
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">No. Wo</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="wo"
                                placeholder="Masukkan Nomor Wo" value="{{$check->wo}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">No. Polisi</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="nopol" value="{{ $check->plat_number }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Service Advisor</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="advisor" id="advisor" class="form-control">
                                <option value="{{ $check->sa_id }}" selected>{{ $check->advisor->name }}
                                    @if (Auth::user()->role !== 'admin')
                                        @foreach(App\Models\ServiceAdvisor::where('status', 'active')->where('client_id', Auth::user()->employee->client_id)->orderBy('name')->get() as $advisor)
                                            <option value="{{ $advisor->id }}">{{ $advisor->name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Merek dan Tipe Kendaraan</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="type" id="type" class="form-control">
                                <option value="{{ $check->type_id }}" selected>{{ $check->types->name }}
                                @foreach(App\Models\MasterType::where('status', 'active')->orderBy('name')->get() as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h2>Hasil Post Check</h2>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Kilometer Kendaraan</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="km"
                                placeholder="Masukkan Kilometer Kendaraan" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">High Pressure (199.1 Psi - 227.5 Psi)</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="high"
                                placeholder="Masukkan High Pressure Kendaraan" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Low Pressure (21.3 Psi - 35.5 Psi)</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="low"
                                placeholder="Masukkan Low Pressure Kendaraan" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Suhu Blower (4 °C - 8 °C)</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="suhu"
                                placeholder="Masukkan Suhu Blower Kendaraan" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Wind Speed (2.5 m/s - 4 m/s)</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="wind"
                                placeholder="Masukkan Wind Speed Kendaraan" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'compressor')->pluck('item')->first())}}:</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="compressor" id="compressor" class="form-control">
                                @foreach(explode(',', App\Models\MasterItem::where('slug', 'compressor')->pluck('checklist')->first()) as $client)
                                    <option value="{{ $client }}">{{ $client }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-labe l text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'cabin-air-filter')->pluck('item')->first())}}:</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="cabin" id="cabin" class="form-control">
                                @foreach(explode(',', App\Models\MasterItem::where('slug', 'cabin-air-filter')->pluck('checklist')->first()) as $client)
                                    <option value="{{ $client }}">{{ $client }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">{{ ucwords(App\Models\MasterItem::where('slug', 'blower')->pluck('item')->first())}}:</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="blower" id="blower" class="form-control">
                                @foreach(explode(',', App\Models\MasterItem::where('slug', 'blower')->pluck('checklist')->first()) as $client)
                                    <option value="{{ $client }}">{{ $client }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Motor Fan: </label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="fan"
                                placeholder="Masukkan Motor Fan" max="30" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Hasil Pengerjaan</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <textarea class="form-control" name="saran" id="exampleTextarea" rows="3" maxlength="75"></textarea>
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
    @section('scripts')
        <script src="{{url('/custom/checking.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
