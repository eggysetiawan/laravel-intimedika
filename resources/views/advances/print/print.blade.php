<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/ipi2.png') }}" type="image/png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" media="all"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" media="all"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" media="all"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/style_master.css') }}" media="all">

    <title>IPI Portal | Advance</title>

</head>

<body class="body_pdf">
    <div class="pdf">
        <div>
            <center>
                <h3>FORM ADVANCE PERJALANAN DINAS</h3>
                <h3>PT. INTIMEDIKA PUSPA INDAH</h3>
            </center>
        </div>
        <div>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $advance->author->name }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $advance->author->position }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $advance->objective }}</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>{{ $advance->destination }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pelaksanaan</td>
                    <td>:</td>
                    <td>{{ $ongoing_date }}</td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td>{{ $advance->author->phone }}</td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <table cellspacing="0" cellpadding="8" border="1" class="advance">
                <thead>
                    <tr>
                        <th style="width: 1%">No</th>
                        <th>Uraian Keperluan</th>
                        <th>Harga kebutuhan</th>
                        <th style="width: 1%">Hari/jumlah</th>
                        <th>Total biaya</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($advance->needs as $need)
                        <tr>
                            <td style="width: 1%">{{ $loop->iteration }}</td>
                            <td>{{ $need->need }}</td>
                            <td>@currency($need->price)</td>
                            <td style="width: 1%">{{ $need->day }}</td>
                            <td>@currency($need->total)</td>
                            <td>{{ $need->note }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div>
            <table class="h5 font-weight-bold">
                <tr>
                    <td>Total pengajuan perjalanan dinas</td>
                    <td>:</td>
                    <td>@currency($advance->needs->sum('total'))</td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <strong style="margin-bottom: 5px;">Catatan:</strong>
            <p>Untuk permohonan biaya perjalanan dinas, jika tiket Bis/KA/Pesawat dipesan melalui Kantor, maka tidak
                perlu dimasukkan dalam permohonan</p>
        </div>
    </div>

    <div>
        <table class="table-ttd">
            <tr>
                <th>Diajukan oleh,</th>
                <th style="width: 250px;">Disetujui oleh,</th>
                <th>Diketahui oleh,</th>
            </tr>
            <tr>
                <td>{{ $advance->created_at->format('d-m-Y') }},</td>
                <td>{{ $advance->created_at->format('d-m-Y') }},</td>
                <td>{{ $advance->created_at->format('d-m-Y') }},</td>

            </tr>
            <tr class="ttd">
                <td>
                    <div style="height:30%; width:100%;position:relative;">
                        ttd
                    </div>
                </td>
                <td>
                    <div style="height:30%; width:100%;position:relative;">
                        ttd
                    </div>
                </td>
                <td>
                    <div style="height:30%; width:100%;position:relative;">
                        ttd
                    </div>
                </td>
            </tr>
            <tr class="tengahh">
                <td>Pembuat/Pemohon</td>
                <td>Atasan/kordinator &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Keuangan&nbsp;&nbsp;&nbsp;</td>
                <td>Kasir/kordinator keuangan</td>
            </tr>
        </table>
    </div>



</body>

</html>
