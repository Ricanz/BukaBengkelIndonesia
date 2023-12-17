<x-guest-layout>
    <div class="container">
        <h2 class="gutter-b">{{ $data->title }}</h2>
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Section-->
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4 gutter-b">
                            <img src="{{ $data->image }}" style="height: auto; width: 100%; max-width: fit-content;" alt="image" />
                        </div>
                        <!--end::Pic-->
                        <div class="d-flex align-items-center">
                            <!--begin::Info-->
                            <div class="d-flex flex-column mr-auto">
                                <!--begin: Title-->
                                <a href="#" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $data->title }}</a>
                                <span class="text-muted font-weight-bold">Evaporator</span>
                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Text-->
                        <div class="mb-7 mt-3">
                            {!! $data->description !!}
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex align-items-center">
                        <a href="{{ url('articles') }}" class="btn btn-primary btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">Kembali</a>
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Row-->
    </div>
</x-guest-layout>
