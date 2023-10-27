<x-app-layout>
    <div class="container">
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="row mt-0 mt-lg-3">
            <div class="col-xl-4">
                <!--begin::Mixed Widget 17-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="card-title font-weight-bolder">
                            <div class="card-label">Informasi Data Teknisi
                                <div class="font-size-sm text-muted mt-2">{{ $total }} Total Checking</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-0 d-flex flex-column">
                        <!--begin::Items-->
                        <div class="flex-grow-1 card-spacer">
                            <div class="row row-paddingless mt-5 mb-10">
                                <!--begin::Item-->
                                <div class="col">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-info mr-4 flex-shrink-0">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-info">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path
                                                                d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder">{{ count($standart_checking) }}</div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">Standart Checking
                                            </div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="col">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-danger">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                fill="#000000" />
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
                                                                x="16.3255682" y="2.94551858" width="3"
                                                                height="18" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder">{{ count($complete_checking) }}</div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">Complete Checking
                                            </div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Widget Item-->
                            </div>
                            <div class="row row-paddingless">
                                <!--begin::Item-->
                                <div class="col">
                                    <div class="d-flex align-items-center mr-2">
                                        <span class="symbol-label">
                                            <img src="{{ asset($employee->client->image) }}"
                                                class="align-self-center" alt="" style="height: 90px; width: auto; margin-bottom: 5px;"/>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="col">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" opacity="0.3" x="4" y="4"
                                                                width="8" height="16" />
                                                            <path
                                                                d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder">{{ $employee->fullname }}</div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">{{ $employee->client->title }}
                                            </div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Item-->
                            </div>
                        </div>
                        <!--end::Items-->
                        <!--begin::Chart-->
                        <div id="kt_mixed_widget_17_chart" class="card-rounded-bottom" data-color="primary"
                            style="height: 200px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 17-->
            </div>
            <div class="col-lg-8">
                <!--begin::Advance Table Widget 2-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Ringkasan Checking</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Data ringkasan hasil
                                checking</span>
                        </h3>
                        <div class="card-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                                <li class="nav-item">
                                    <a class="nav-link py-2 px-4 active" data-toggle="tab"
                                        href="#kt_tab_pane_11_1">Semua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 px-4" data-toggle="tab"
                                        href="#kt_tab_pane_11_2">Standart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-2 px-4" data-toggle="tab"
                                        href="#kt_tab_pane_11_3">Complete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2 pb-0 mt-n3">
                        <div class="tab-content mt-5" id="myTabTables11">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade  show active" id="kt_tab_pane_11_1" role="tabpanel"
                                aria-labelledby="kt_tab_pane_11_1">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                            <tr>
                                                <th class="p-0 min-w-200px">Nomor Wo</th>
                                                <th class="p-0 min-w-100px text-center">Nomor Polisi</th>
                                                <th class="p-0 min-w-125px text-center">Teknisi</th>
                                                <th class="p-0 min-w-110px text-center">Service Advisor</th>
                                                <th class="p-0 min-w-50px text-center">Bengkel</th>
                                                <th class="p-0 min-w-50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checking as $item)
                                                
                                            <tr>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $item->wo }}</a>
                                                    <div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $item->plat_number }}</span>
                                                    <span class="text-muted font-weight-bold">{{ $item->checking_type }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-bold">{{ $employee->fullname }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-bold">{{ $item->advisor->name }}</span>
                                                </td>
                                                <td class="text-start pr-0">
                                                    <span class="text-muted font-weight-bold">{{ $item->client->title }}</span>
                                                </td>
                                                <td class="text-start pr-0">
                                                    <a href="{{ $item->checking_type === 'Standart' ? route('checking.show', $item->id) : route('complete.show', $item->id) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                width="24px" height="24px" viewBox="0 0 24 24"
                                                                version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                    <path
                                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade" id="kt_tab_pane_11_2" role="tabpanel"
                                aria-labelledby="kt_tab_pane_11_2">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                            <tr>
                                                <th class="p-0 min-w-200px">Nomor Wo</th>
                                                <th class="p-0 min-w-100px text-center">Nomor Polisi</th>
                                                <th class="p-0 min-w-125px text-center">Teknisi</th>
                                                <th class="p-0 min-w-110px text-center">Service Advisor</th>
                                                <th class="p-0 min-w-50px text-center">Bengkel</th>
                                                <th class="p-0 min-w-50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($standart_checking as $item)
                                                
                                            <tr>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $item->wo }}</a>
                                                    <div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $item->plat_number }}</span>
                                                    <span class="text-muted font-weight-bold">{{ $item->checking_type }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-bold">{{ $employee->fullname }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-bold">{{ $item->advisor->name }}</span>
                                                </td>
                                                <td class="text-start pr-0">
                                                    <span class="text-muted font-weight-bold">{{ $item->client->title }}</span>
                                                </td>
                                                <td class="text-start pr-0">
                                                    <a href="{{ $item->checking_type === 'Standart' ? route('checking.show', $item->id) : route('complete.show', $item->id) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                width="24px" height="24px" viewBox="0 0 24 24"
                                                                version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                    <path
                                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade" id="kt_tab_pane_11_3" role="tabpanel"
                                aria-labelledby="kt_tab_pane_11_3">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                            <tr>
                                                <th class="p-0 min-w-200px">Nomor Wo</th>
                                                <th class="p-0 min-w-100px text-center">Nomor Polisi</th>
                                                <th class="p-0 min-w-125px text-center">Teknisi</th>
                                                <th class="p-0 min-w-110px text-center">Service Advisor</th>
                                                <th class="p-0 min-w-50px text-center">Bengkel</th>
                                                <th class="p-0 min-w-50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($complete_checking as $item)
                                                
                                            <tr>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $item->wo }}</a>
                                                    <div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $item->plat_number }}</span>
                                                    <span class="text-muted font-weight-bold">{{ $item->checking_type }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-bold">{{ $employee->fullname }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-bold">{{ $item->advisor->name }}</span>
                                                </td>
                                                <td class="text-start pr-0">
                                                    <span class="text-muted font-weight-bold">{{ $item->client->title }}</span>
                                                </td>
                                                <td class="text-start pr-0">
                                                    <a href="{{ $item->checking_type === 'Standart' ? route('checking.show', $item->id) : route('complete.show', $item->id) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                width="24px" height="24px" viewBox="0 0 24 24"
                                                                version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                    <path
                                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 2-->
            </div>
        </div>
        <!--end::Row-->
        <!--end::Dashboard-->
    </div>

</x-app-layout>
