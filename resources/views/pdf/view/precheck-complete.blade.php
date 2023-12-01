<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pengecekan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;900&family=Sometype+Mono&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Nunito&family=Poppins:wght@400;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("pdf/complete.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                            <p id="ch-one" style="font-family: 'Poppins', sans-serif;">PRE-CHECK COMPLETE</p>
                            <p id="ch-two">{{ $checking->plat_number }}</p>
                            <p id="ch-three">{{ $checking->types->name }}</p>
                            <p id="ch-four" style="margin-bottom: 20px;">Saran Perbaikan : <strong>{{ $checking->saran }}</strong></p>
                            <a target="_BLANK" href="{{ route('download.complete_pre', $checking->id) }}" class="btn"><i class="fa fa-download"></i> Download</a>
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
                    <th style="width: 35%; padding: 10px; border-radius: 20px 20px 0 0; color: white;" id="check-one">HASIL DIAGNOSA</th>
                </tr>
                @foreach ($checking->complete as $key => $item)
                    <?php 
                    $bg = "";
                    if ($key % 2 == 1) {
                        $bg = "bg-table";
                    }
                    ?>
                    <tr>
                        <td class="bodr-rc {{ $bg }}" style="padding: 10px;">
                            @if ($item->master->icon)
                            <img src="{{ $item->master->icon }}"
                                width="30" height="30" />
                            @endif
                        </td>
                        <td class="bodl-rc {{ $bg }}">
                            {{ $item->master->name }}: <br><b>{{ $item->master->label_desc }}</b>
                        </td>
                        <td class="bodl-rc text-center {{ $bg }} {{ !$item->pass ? "not-pass-check" : "pass-check" }}">
                            <strong>{{$item->val_check}}</strong>
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
                <center>
                    <div style="width:100%;">
                        <div class="flex-container">
                            @foreach ($images as $key => $item)
                                <div class="flex-item">
                                    <center>
                                        <div class="ic-mt">
                                            <div id="bg-image">
                                                <img src="{{ env('APP_URL') .'/'.$item->image}}" class="ic-b" width="100%" height="100%" />
                                                <p class="text-center" style="padding: 5px 5px 0 5px; color: white;">{{$item->master->description}}</p>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </center>
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
