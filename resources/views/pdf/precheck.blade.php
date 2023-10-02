<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pengecekan</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            /* font-family: "Times New Roman", Times, serif; */
        }

        .container {
            padding: 0px 15px;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .uppercase {
            text-transform: uppercase !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-italic {
            font-style: italic;
        }

        .text-rede {
            color: #e95e5e;
        }

        .text-greene {
            color: #03b115;
        }

        .logo-denso {
            margin-left: 9px;
        }

        #background {
            position: absolute;
            z-index: 0;
            display: block;
            min-height: 50%;
            min-width: 50%;
        }

        #content {
            position: absolute;
            z-index: 1;
        }

        #bg-wt {
            margin-top: 135px;
            margin-left: 80px;
            width: 600px;
            height: 600px;
        }

        #head {
            padding: 10px 0px 10px 0px;
        }

        #head-content {
            padding: 10px 0px 10px 0px;
        }

        #right-head {
            width: 40%;
            text-align: right !important;
        }

        #left-head {
            width: 60%;
            text-align: left !important;
        }

        #rh-one {
            color: #1f2690;
            text-transform: uppercase;
            font-weight: bold;
        }

        #rh-four {
            color: #e32873;
            font-weight: bold;
        }

        #rh-five {
            padding: 0px;
            margin: 0px;
            font-weight: bold;
        }

        #line-neck {
            background-color: #0ca1c2;
            font-weight: bold;
            font-size: 16px;
            color: #FFFFFF;
            padding: 10px 0px 10px 0px;
            margin-bottom: 20px;
        }

        table.tb-note {
            border-collapse: collapse;
            width: 100%;
            border: solid 3px #0ca1c2;
        }

        tr.br-topn td {
            border-right: solid 3px #0ca1c2;
        }

        #n-three {
            width: 190px;
            background-color: #e95e5e;
            color: #FFFFFF;
            text-transform: uppercase;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            margin: 10px 0px 0px 10px;
        }

        #n-three-one {
            margin: 8px 10px 0px 00px;
            float: right;
        }

        #warning {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        #warning-one {
            text-align: center !important;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 20px;
            color: #FFFFFF;
            background-color: #e95e5e;
            padding: 6px 0px;
        }


        table.tb-rc {
            border-collapse: collapse;
            font-size: 15px;
        }

        .tb-rc th {
            padding: 3px 10px;
            border: solid 3px #0ca1c2;
        }

        .bod-rc {
            padding: 0px 0px 0px 15px;
            border: solid 3px #0ca1c2;
        }

        .bodl-rc {
            padding: 0px 0px 0px 15px;
            border: solid 3px #0ca1c2;
            border-left: none;
        }

        .bodr-rc {
            width: 20px;
            padding: 0px 0px 0px 15px;
            border: solid 3px #0ca1c2;
            border-right: none;
        }

        .bodl-rc {
            padding: 0px 0px 0px 15px;
            border: solid 3px #0ca1c2;
            border-left: none;
        }

        .nobodl-rc {
            border-left: none;
        }

        tr.nobod-rc td {
            border-left: none;
            border-right: none;
            border-bottom: none;
        }

        #ic-one {
            text-align: center !important;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            color: #FFFFFF;
            padding: 5px 0px;
            background-color: #0ca1c2;
            border-radius: 10px;
            width: 50%;
        }

        .ic-mt {
            margin-top: 20px;
        }

        .ic-three {
            width: 70%;
        }

        .ic-b {
            border: 3px solid #0ca1c2;
        }

        #ict-one {
            margin-left: 120px;
        }

        #ict-two {
            margin-right: 120px;
        }

        #ch-one {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 28px;
            text-align: left;
            font-family: 'Segoe UI', 'Tahoma', Geneva, Verdana, sans-serif;
            font-weight: 600;
        }

        #ch-two {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 23px;
            color: #1f2690;
            text-align: left;
        }

        #ch-three {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            text-align: left;
        }

        #ch-three {
            font-weight: bold;
            font-size: 18px;
            text-align: left;
        }

        #head-content #right-head {
            width: 40%;
            text-align: right !important;
        }

        #check-one {
            background-image: linear-gradient(to right, red, yellow);
        }
    </style>
</head>

<body>
    {{-- <div id="background">
        <img src="assets/theme/images/bbi-ul/images/img-pcs/wt.png" id="bg-wt">
    </div> --}}

    <div id="content" style="width: 800px;">
        <div id="image-head" style="width: auto; height:50px; margin-bottom:15px">
            <img src="{{ 'https://development.bukabengkelindonesia.com'.$checking->client->image }}"
                alt="Logo" style="height:75px;object-fit:contain">
        </div>
        <div id="head-content">
            <table cellspacing="0" style="width:100%;" class="container">
                <tbody style="width: 100%">
                    <tr>
                        <td id="left-head">
                            <p id="ch-one">PRE-CHECK STANDAR</p>
                            <p id="ch-two">{{ $checking->plat_number }}</p>
                            <p id="ch-three">{{ $checking->types->name }}</p>
                            <p id="ch-four">Saran Perbaikan : <strong>{{ $checking->standart->saran }}</strong></p>
                        </td>
                        <td id="right-head">
                            <p id="rh-one">S.A : {{ $checking->advisor->name }}</p>
                            <p id="rh-two">{{ $checking->created_at->format('DD, d-m-Y | H:i') }}</p>
                            <p id="rh-three">No. WO : {{ $checking->wo }}</b></p>
                            <p id="rh-four">*Lakukan Service Mobil Anda</p>
                            <p id="rh-five">Teknisi: <b><label id="rh-five">{{ $checking->employee->fullname }}</label></b>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <div id="warning">
            <table cellspacing="0" style="width:100%;" class="container tb-warning">
                <tr>
                    <td>
                        <p id="warning-one">Lakukan service mobil anda</p>
                    </td>
                </tr>
            </table>
        </div> --}}
        <div id="result-check">
            <table cellspacing="0" class="container tb-rc" style="width: 100%;">
                <tr>
                    <th id="check-one" colspan="2">STANDAR NORMAL</th>
                    <th>PRE-CHECK</th>
                    <th>TAMBAHAN PEMERIKSAAN</th>
                </tr>
                <tr>
                    <td class="bodr-rc">
                        <img src="https://autonetmagz.com/wp-content/uploads/2015/04/Honda-Civic-Concept-Tampak-Depan.jpg"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">
                        High Pressure: <br><b>199.1 Psi - 227.5 Psi</b>
                    </td>
                    <td class="bodl-rc text-center">
                        <strong>226.9</strong> Psi
                    </td>
                    <td class="bodl-rc">
                        Kompressor: <br><b>Berfungsi Normal</b>
                    </td>
                </tr>
                <tr>
                    <td class="bodr-rc">
                        <img src="https://autonetmagz.com/wp-content/uploads/2015/04/Honda-Civic-Concept-Tampak-Depan.jpg"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">Low Pressure: <br><b>21.3 Psi - 35.5 Psi</b></td>
                    <td class="bodl-rc text-center">
                        <strong>21.1</strong> Psi
                    </td>
                    <td class="bodl-rc">
                        Cabin Air Filter: <br><b>Bersih</b>
                    </td>
                </tr>
                <tr>
                    <td class="bodr-rc">
                        <img src="https://autonetmagz.com/wp-content/uploads/2015/04/Honda-Civic-Concept-Tampak-Depan.jpg"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">Suhu Blower: <br><b>4 째C - 7 째C</b></td>
                    <td class="bodl-rc text-center">
                        <strong>10</strong> °C
                    </td>
                    <td class="bodl-rc">
                        Blower: <br><b>Bersih</b>
                    </td>
                </tr>
                <tr>
                    <td class="bodr-rc">
                        <img src="https://autonetmagz.com/wp-content/uploads/2015/04/Honda-Civic-Concept-Tampak-Depan.jpg"
                            width="30" height="30" />
                    </td>
                    <td class="bodl-rc">Wind Speed: <br><b>2.5 m/s - 4 m/s</b></td>
                    <td class="bodl-rc text-center">
                        <strong>2.2</strong> m/s
                    </td>
                    <td class="bodl-rc">
                        Motor Fan: <br><b>Ganti ≤ 100.000 km</b>
                    </td>
                </tr>
                {{-- <tr class="nobod-rc">
                    <td colspan="3">
                        <p>*Sumber Referensi </p>
                        <p class="logo-denso"><img src="http://127.0.0.1:8002/tadmin/images/denso-logo.png"
                                width="50" height="20" /></p>
                    </td>
                </tr> --}}
            </table>
        </div>
        <div id="image-check">
            <table cellspacing="0" style="width:100%;">
                <tr>
                    <td></td>
                    <td id="ic-one">
                        <p class="text-center">KONDISI MOBIL ANDA</p>
                    </td>
                    <td></td>
                </tr>
                <tr id="ic-two">
                    <td class="ic-three">
                        <div class="ic-mt">
                            <img src="http://127.0.0.1:8000/storage/public/1696060144_6517d2f02a919.jpg" class="ic-b" width="246" height="180" />
                            <p class="text-center"><b>Tampak Depan Mobil</b></p>
                        </div>
                    </td>
                    <td class="ic-three">
                        <div class="ic-mt">
                            <img src="https://bukabengkelindonesia.com/assets/theme/images/bbi/logo-192x192.png" class="ic-b" width="246" height="180" />
                            <p class="text-center"><b>KM</b> KM
                        </div>
                    </td>
                    <td class="ic-three">
                        <div class="ic-mt">
                            <img src="https://development.bukabengkelindonesia.com/tadmin/media/images/logo-192x192.png" class="ic-b" width="246" height="180" />
                            <p class="text-center"><b>SUHU & Windspeed</b></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="image-check-two">
            <table cellspacing="0" style="width:100%;" class="container">
                <tr>
                    <td>
                        <div class="ic-mt text-center" id="ict-one">
                            <img src="" class="ic-b" width="246" height="180" />
                            <p class="text-center"><b>Blower</b></p>
                        </div>
                    </td>
                    <td>
                        <div class="ic-mt text-center" id="ict-two">
                            <img src="" class="ic-b" width="246" height="180" />
                            <p class="text-center"><b>Cabin Air Filter / Evaporator</b></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div id="line-neck">
            <table cellspacing="0" style="width:100%;" class="container">
                <tr>
                    <td>
                        <p class="text-center">Alamat</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
