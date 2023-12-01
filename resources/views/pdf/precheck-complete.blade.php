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
            font-family: Dejavu Sans;
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
            width: 200px;
            height: 200px;
            position: absolute;
            top: -4%;
            left: 147%;
            opacity: 0.1;
        }

        #page-2 {
            width: 200px;
            height: 200px;
            position: absolute;
            top: -4%;
            left: 141%;
            opacity: 0.1;
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
            font-weight: bold;
            font-size: 16px;
            color: #FFFFFF;
            padding: 10px 0px 10px 0px;
            margin-bottom: 20px;
        }

        table.tb-note {
            border-collapse: collapse;
            width: 100%;
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
        }

        .bod-rc {
            padding: 0px 0px 0px 15px;
        }

        .bodl-rc {
            padding: 0px 0px 0px 15px;
            border-left: none;
        }

        .bodr-rc {
            width: 20px;
            padding: 0px 0px 0px 15px;
        }

        .bodl-rc {
            padding: 0px 0px 0px 15px;
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
            border-radius: 10px;
            width: 50%;
        }

        .ic-mt {
            margin-top: 20px;
        }

        .ic-three {
            width: 70%;
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
            font-family: Dejavu Sans !important;
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
            background-color: #1f2690;
        }

        #condition {
            padding-left: 20px;
        }

        #condition h2 {
            color: #1f2690;
            text-transform: uppercase;
            font-weight: bold;
        }

        #bg-image {
            padding-bottom: 35px;
            background-color: #23a5ea;
            width: 200px;
            height: 130px;
            border-radius: 0 10px 10px 10px;
        }

        #line-notes {
            padding: 20px;
            margin: 20px 60px 20px 60px;
            background-color: #fae3eb;
            border-radius: 20px;
        }

        #footer {
            background-color: #1f2690;
            text-align: center;
        }

        /* #background-table {
            background-color: #1f2690;
            height: 250px;
            border-radius: 30px;
            position: absolute;
            z-index: 2;
            top: 50%;
            transform: translate(-50%, -50%);
            left: 50%;
            width: 90%;
            z-index: -1;
        } */

        #parent {
            position: relative;
            /* background-color: #03b115; */
        }

        .pass-check {
            color: #03b115 !important;
        }

        .not-pass-check {
            color: #e95e5e !important;
        }

        .bg-table {
            background-color: #f6f8fd;
        }
    </style>
</head>

<body>
    <div id="background">
        <img src="{{ env('APP_URL') . '/tadmin/media/images/logo-192x192.png' }}" id="bg-wt">
    </div>

    <div id="content" style="width: 800px;">
        <div id="image-head" style="width: auto; height:40px; margin-bottom:15px; padding: 10px; margin-left:10px;">
            <img src="{{ env('APP_URL') . '/' . $checking->client->image }}" alt="Logo"
                style="height:75px;object-fit:contain">
        </div>
        <div id="head-content">
            <table cellspacing="0" style="width:100%;" class="container">
                <tbody style="width: 100%">
                    <tr>
                        <td id="left-head">
                            <p id="ch-one" style="font-family: Dejavu Sans;">PRE-CHECK COMPLETE</p>
                            <p id="ch-two">{{ $checking->plat_number }}</p>
                            <p id="ch-three">{{ $checking->types->name }}</p>
                            <p id="ch-four">Saran Perbaikan : <strong>{{ $checking->saran }}</strong></p>
                        </td>
                        <td id="right-head">
                            <p id="rh-one">S.A : {{ $checking->advisor->name }}</p>
                            <p id="rh-two">{{ $checking->created_at->format('D, d-m-Y | H:i') }}</p>
                            <p id="rh-three">No. WO : {{ $checking->wo }}</b></p>
                            <p id="rh-four">*Lakukan Service Mobil Anda</p>
                            <p id="rh-five">Teknisi: <b><label
                                        id="rh-five">{{ $checking->employee->fullname }}</label></b>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="result-check" style="margin-top: 10px;">
            <table cellspacing="0" class="container tb-rc" style="width: 100%;">
                <tr>
                    <th style="width: 40%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one"
                        colspan="2">STANDAR NORMAL</th>
                    <th style="width: 25%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one">
                        PRE-CHECK</th>
                    <th style="width: 35%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one">
                        HASIL DIAGNOSA</th>
                </tr>
                @foreach ($checking->complete as $key => $item)
                    <?php
                    $bg = '';
                    if ($key % 2 == 1) {
                        $bg = 'bg-table';
                    }
                    ?>
                    <tr>
                        <td class="bodr-rc {{ $bg }}" style="padding: 10px;">
                            <img src="{{ env('APP_URL') . $item->master->icon }}" width="30" height="30" />
                        </td>
                        <td class="bodl-rc {{ $bg }}">
                            {{ $item->master->description }}: <br><b>{{ $item->master->name }}</b>
                        </td>
                        <td class="bodl-rc text-center {{ $bg }} {{ !$item->pass ? 'not-pass-check' : 'pass-check' }}">
                            <strong>{{ $item->val_check }}</strong>
                        </td>
                        <td class="bodl-rc">
                            {{ $item->value_title }}: <br><b>{{ $item->value }}</b>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div id="condition" style="margin-top: 10px;">
            <table cellspacing="0" style="width:100%;">
                <tr id="ic-two-two" style=" padding-left: 20px;">
                    <td class="ic-three" style="width: 200px;">
                        *Sumber Refrensi
                        <div id="image-head" style="width: auto; height:50px;">
                            <img src="{{ env('APP_URL') . '/tadmin/images/denso-sumber.jpg' }}" alt="Logo"
                                style="height:25px;object-fit:contain">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div id="condition" style="page-break-before: always;">
            <div id="background">
                <img src="{{ env('APP_URL') . '/tadmin/media/images/logo-192x192.png' }}" id="page-2">
            </div>
            <table cellspacing="0" style="width:100%;">
                <tr id="ic-two-two" style=" padding-left: 20px;">
                    <td class="ic-three" style="width: 200px;">
                        <div id="image-head"
                            style="width: auto; height:40px; margin-bottom:15px; padding: 10px; margin-left:10px;">
                            <img src="{{ env('APP_URL') . '/' . $checking->client->image }}" alt="Logo"
                                style="height:75px;object-fit:contain">
                        </div>
                    </td>
                    <td class="ic-three"></td>
                </tr>
                <tr id="ic-two-two" style=" padding-left: 20px;" align="center">
                    <td class="ic-three" colspan="2" style="padding-left: 2%;">
                        <p id="ch-one" style="font-family: Dejavu Sans;">PRE-CHECK COMPLETE</p>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
        <h2 id="condition" align="center" style="color: #1f2690; margin: 0; padding: 0;">KONDISI MOBIL ANDA</h2>
        <div id="parent">
            <div id="background-table"></div>
            @if (count($first_batch) > 0)
                <div id="image-check-two" style="padding: 0 85px 0 85px">
                    <center>
                        <table cellspacing="0" style="width:100%;">
                            <tr id="ic-two-two">
                                @foreach ($first_batch as $key => $item)
                                    <td class="ic-three">
                                        <center>
                                            <div class="ic-mt">
                                                <div id="bg-image">
                                                    <img src="{{ env('APP_URL') . '/' . $item->image }}" class="ic-b"
                                                        width="100%" height="100%" />
                                                    <p class="text-center"
                                                        style="padding: 5px 5px 0 5px; color: white;">
                                                        {{ $item->master->description }}</p>
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </center>
                </div>
            @endif

            @if (count($second_batch) > 0)
                <div id="image-check-two" style="padding: 0 85px 0 85px">
                    <center>
                        <table cellspacing="0" style="width:100%;">
                            <tr id="ic-two-two">
                                @foreach ($second_batch as $key => $item)
                                    <td class="ic-three">
                                        <center>
                                            <div class="ic-mt">
                                                <div id="bg-image">
                                                    <img src="{{ env('APP_URL') . '/' . $item->image }}" class="ic-b"
                                                        width="100%" height="100%" />
                                                    <p class="text-center"
                                                        style="padding: 5px 5px 0 5px; color: white;">
                                                        {{ $item->master->description }}</p>
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </center>
                </div>
            @endif

            @if (count($third_batch) > 0)
                <div id="image-check-two" style="padding: 0 85px 0 85px">
                    <center>
                        <table cellspacing="0" style="width:100%;">
                            <tr id="ic-two-two">
                                @foreach ($third_batch as $key => $item)
                                    <td class="ic-three">
                                        <center>
                                            <div class="ic-mt">
                                                <div id="bg-image">
                                                    <img src="{{ env('APP_URL') . '/' . $item->image }}" class="ic-b"
                                                        width="100%" height="100%" />
                                                    <p class="text-center"
                                                        style="padding: 5px 5px 0 5px; color: white;">
                                                        {{ $item->master->description }}</p>
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </center>
                </div>
            @endif
            @if (count($fourth_batch) > 0)
                <div id="image-check-two" style="padding: 0 85px 0 85px">
                    <center>
                        <table cellspacing="0" style="width:100%;">
                            <tr id="ic-two-two">
                                @foreach ($fourth_batch as $key => $item)
                                    <td class="ic-three">
                                        <center>
                                            <div class="ic-mt">
                                                <div id="bg-image">
                                                    <img src="{{ env('APP_URL') . '/' . $item->image }}" class="ic-b"
                                                        width="100%" height="100%" />
                                                    <p class="text-center"
                                                        style="padding: 5px 5px 0 5px; color: white;">
                                                        {{ $item->master->description }}</p>
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </center>
                </div>
            @endif
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

        <div id="footer" style="position:absolute;bottom:0; width:100%">
            <table cellspacing="0" style="width:100%;" class="container">
                <tr>
                    <td>
                        <p style="text-align: center; color: white; font-size: 13px;">
                            {{ $checking->client->address }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
