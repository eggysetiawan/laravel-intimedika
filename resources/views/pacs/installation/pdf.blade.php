<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IPI | File Instalasi</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h3>
                <center>Berkas Instalasi {{ $pacsInstallation->hospital->name }}</center>
            </h3>
        </div>
        @foreach ($pacsInstallation->getMedia('files') as $files)
            <div class="row">
                <img src="{{ asset($files->getFullUrl()) }}" class="img-fluid" alt="File Instalasi" width="600" />
            </div>
        @endforeach
    </div>
</body>

</html>
