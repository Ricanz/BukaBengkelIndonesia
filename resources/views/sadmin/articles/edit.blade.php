<x-app-layout>
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span>
                    <h3 class="card-label">Ubah Artikel</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="update_article_form" enctype="multipart/form-data">
                    @csrf
                    <div class="image-input image-input-outline" id="kt_image_1">
                        <input type="hidden" name="id" value="{{ $data->id }}" >
                        <div class="image-input-wrapper"
                            style="background-image: url({{$data->image}})"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title=""
                            data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="file" accept=".png, .jpg, .jpeg, .heic" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Judul</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <input type="text" class="form-control" name="title"
                                value="{{ $data->title }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Deskripsi</label>
                        <textarea name="description" id="description" hidden></textarea>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="summernote" id="kt_summernote_1">{!! $data->description !!}</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-left col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select name="status" id="status" class="form-control">
                                <option value="{{ $data->status }}">{{ $data->status }}</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/master/articles') }}" class="btn btn-light-primary font-weight-bold">Back</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">Save
                            changes</button>
                    </div>
                </form>
            </form>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('tadmin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{url('/custom/article.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
