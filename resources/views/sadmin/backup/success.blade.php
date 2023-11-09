<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success Backup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h2>Berhasil Backup Data</h2>
    <a href="{{ url('/backup') }}">Kembali</a>
    <br>
    <a class="btn btn-primary" href="{{ url('standar/checking') }}">Standart</a>
    <a class="btn btn-warning" href="{{ url('standar/comprlete') }}">Complete</a>
</body>
</html>