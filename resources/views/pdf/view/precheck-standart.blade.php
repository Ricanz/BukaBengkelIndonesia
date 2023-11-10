<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pengecekan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;900&family=Sometype+Mono&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Nunito&family=Poppins:wght@400;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("pdf/precheck-new.css") }}">

</head>

<body>

    <div id="content">
        <div id="background">
            <img src="{{ env('APP_URL').'/tadmin/media/images/logo-192x192.png' }}" id="bg-wt">
        </div>
        <div id="image-head" style="width: auto; height:40px; margin-bottom:15px; padding: 10px; margin-left:10px;">
            <img src="{{ env('APP_URL') .'/'.$checking->client->image }}"
                alt="Logo" style="height:75px;object-fit:contain">
        </div>
        <div id="head-content">
            <table cellspacing="0" style="width:100%;" class="container">
                <tbody style="width: 100%">
                    <tr>
                        <td id="left-head">
                            <p id="ch-one" style="font-family: 'Poppins', sans-serif;">PRE-CHECK STANDAR</p>
                            <p id="ch-two">{{ $checking->plat_number }}</p>
                            <p id="ch-three">{{ $checking->types->name }}</p>
                            <p id="ch-four">Saran Perbaikan : <strong>{{ $checking->saran }}</strong></p>
                        </td>
                        <td id="right-head">
                            <p id="rh-one">S.A : {{ $checking->advisor->name }}</p>
                            <p id="rh-two">{{ $checking->created_at->format('D, d-m-Y | H:i') }}</p>
                            <p id="rh-three">No. WO : {{ $checking->wo }}</b></p>
                            <p id="rh-four">*Lakukan Service Mobil Anda</p>
                            <p id="rh-five">Teknisi: <b><label id="rh-five">{{ $checking->employee->fullname }}</label></b>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="result-check" style="margin-top: 10px;">
            <table cellspacing="0" class="container tb-rc" style="width: 100%;">
                <tr>
                    <th style="width: 40%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one" colspan="2">STANDAR NORMAL</th>
                    <th style="width: 25%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one">PRE-CHECK</th>
                    <th style="width: 35%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one">TAMBAHAN PEMERIKSAAN</th>
                </tr>
                <tr>
                    <td class="bodr-rc" style="padding: 10px;">
                        <img src="{{ env('APP_URL').'/tadmin/images/icon_high_pressure.png' }}"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">
                        High Pressure: <br><b>199.1 Psi - 227.5 Psi</b>
                    </td>
                    @if ((int)$checking->standart->high >= 199.1 && (int)$checking->standart->high <= 227.5)
                        <td class="bodl-rc text-center pass-check">
                            <strong>{{ $checking->standart->high }}</strong> Psi
                        </td>
                    @elseif((int)$checking->standart->high < 199.1 || (int)$checking->standart->high > 227.5)
                        <td class="bodl-rc text-center not-pass-check">
                            <strong>{{ $checking->standart->high }}</strong> Psi
                        </td>
                    @endif
                    <td class="bodl-rc">
                        Kompressor: <br><b>{{ $checking->standart->compressor }}</b>
                    </td>
                </tr>
                <tr style="background-color: #f6f8fd;">
                    <td class="bodr-rc"  style="padding: 10px;">
                        <img src="{{ env('APP_URL').'/tadmin/images/icon_low_pressure.png' }}"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">Low Pressure: <br><b>21.3 Psi - 35.5 Psi</b></td>
                    @if ((int)$checking->standart->low >= 21.3 && (int)$checking->standart->low <= 35.5)
                        <td class="bodl-rc text-center pass-check">
                            <strong>{{ $checking->standart->low }}</strong> Psi
                        </td>
                    @elseif((int)$checking->standart->low < 21.3)
                        <td class="bodl-rc text-center not-pass-check">
                            <strong>{{ $checking->standart->low }}</strong> Psi
                        </td>
                    @endif
                    <td class="bodl-rc">
                        Cabin Air Filter: <br><b>{{ $checking->standart->cabin }}</b>
                    </td>
                </tr>
                <tr>
                    <td class="bodr-rc"  style="padding: 10px;">
                        <img src="{{ env('APP_URL').'/tadmin/images/icon_temperature.png' }}"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">Suhu Blower: <br><b>4 °C - 8 °C</b></td>
                    @if ((int)$checking->standart->suhu >= 4 && (int)$checking->standart->suhu <= 8)
                        <td class="bodl-rc text-center pass-check">
                            <strong>{{ $checking->standart->suhu }}</strong> °C
                        </td>
                    @elseif((int)$checking->standart->suhu < 4 || (int)$checking->standart->suhu > 8)
                        <td class="bodl-rc text-center not-pass-check">
                            <strong>{{ $checking->standart->suhu }}</strong> °C
                        </td>
                    @endif
                    <td class="bodl-rc">
                        Blower: <br><b>{{ $checking->standart->blower }}</b>
                    </td>
                </tr>
                <tr style="background-color: #f6f8fd;">
                    <td class="bodr-rc"  style="padding: 10px;">
                        <img src="{{ env('APP_URL').'/tadmin/images/icon_windspeed.png' }}"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">Wind Speed: <br><b>2.5 m/s - 4 m/s</b></td>
                    @if ((int)$checking->standart->wind >= 2.5 && (int)$checking->standart->wind <= 4)
                        <td class="bodl-rc text-center pass-check">
                            <strong>{{ $checking->standart->wind }}</strong> m/s
                        </td>
                    @elseif((int)$checking->standart->wind < 2.5 || (int)$checking->standart->wind > 4)
                        <td class="bodl-rc text-center not-pass-check">
                            <strong>{{ $checking->standart->wind }}</strong> m/s
                        </td>
                    @endif
                    <td class="bodl-rc">
                        Motor Fan: <br><b>{{ $checking->standart->fan }}</b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="condition" style="margin-top: 10px;">
            <table cellspacing="0" style="width:100%;">
                <tr id="ic-two-two" style=" padding-left: 20px;">
                    <td class="ic-three" style="width: 200px;">
                        *Sumber Refrensi
                        <div id="image-head" style="width: auto; height:50px;">
                            <img src="{{ env('APP_URL').'/tadmin/images/denso-sumber.jpg' }}"
                                alt="Logo" style="height:25px;object-fit:contain">
                        </div>
                    </td>
                    <td class="ic-three">
                        <h2 id="condition">KONDISI MOBIL ANDA</h2>
                    </td>
                </tr>
            </table>
        </div>
        <div id="parent">
            <div id="background-table"></div>
            <div id="image-check-two" style="padding: 0 85px 0 85px">
                <div style="width:100%; margin: auto;">
                    <div class="flex-container" style="margin: auto;">
                        @foreach ($images as $key => $item)
                            <div class="flex-item">
                                <center>
                                    <div class="ic-mt">
                                        <div id="bg-image">
                                            <img src="{{env('APP_URL').'/'.$item->image}}" class="ic-b" width="100%" height="100%" />
                                            <p class="text-center" style="padding: 5px 5px 0 5px; color: white;">{{$item->types->description}}</p>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="line-notes">
            <table cellspacing="0" style="width:100%;" class="container">
                <tr>
                    <td>
                        <p><strong>Catatan Pemeriksaan:</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            {{ $checking->note }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div id="footer" style="padding: 8px 0 8px 0; width:100%">
            <table cellspacing="0" style="width:100%;" class="container">
                <tr>
                    <td>
                        <p style="text-align: center; color: white;">
                            {{ $checking->client->address }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
