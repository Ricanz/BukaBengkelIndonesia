<x-guest-layout>
    <div class="container">
        <h3 class="mb-4">Artikel Buka Bengkel Indonesia</h3>
        <!--begin::Row-->
        <div class="row">
            @foreach ($data as $item)
            <!--begin::Col-->
            <div class="col-xl-6 col-lg-3 col-md-3 col-sm-3">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <div class="d-flex">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-5">
                                <div class="symbol symbol-lg-150">
                                    <img alt="Pic"
                                        src="{{ $item->image }}" />
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin: Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                    <!--begin::User-->
                                    <div class="mr-3">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                            {{ $item->title }}
                                        </a>
                                        <!--end::Name-->
                                        <!--begin::Contacts-->
                                        <div class="d-flex flex-wrap my-2">
                                            <a href="#"
                                                class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                </span>Evaporator</a>
                                        </div>
                                        <!--end::Contacts-->
                                    </div>
                                    <!--begin::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="d-flex align-items-center flex-wrap justify-content-between">
                                    <!--begin::Description-->
                                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2">
                                        {{ $item->short_description }} ...
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <div class="separator separator-solid my-7"></div>
                                <a href="{{ url('/article', $item->slug) }}"
                                    class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Baca Selengkapnya</a>
                                <!--end::Content-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Buttons-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
                
            @endforeach
        </div>
        <!--end::Row-->
    </div>
</x-guest-layout>
