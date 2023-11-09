
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    
<div class="container pt-4">
    <!--begin::Card-->
    <div class="card card-custom align-center">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-supermarket text-primary"></i>
                </span>
                <h3 class="card-label">Berhasil Backup Data!</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="modal-footer">
                <a href="{{ url('/backup') }}" class="btn btn-light-primary font-weight-bold">Kembali</a>
                <a class="btn btn-primary  font-weight-bold" href="{{ url('checking/standart') }}">Standart</a>
                <a class="btn btn-warning  font-weight-bold" href="{{ url('checking/complete') }}">Complete</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
