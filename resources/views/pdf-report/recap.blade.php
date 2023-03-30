<!DOCTYPE html>
<html lang="en">

<head>

    <title>Rekap Absen - {{ $user->name }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <style>

        .table-responsive{
            margin-bottom: 3rem;
        }

        .tab-user tr th{
            text-align: left;
        }

        #customers td, #customers th {
        border: 1px solid white;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #6c757d;
        color: white;
        }
    </style>

</head>

<body id="page-top">

                    <h5 class="mb-2" style="text-align: right;">Rekap Absensi - 2022</h5>

                    <div class="table-responsive">
                        <table class="table tab-user"  width="100%" cellspacing="0">
                            <tr>
                                <th width="20%">Nama</th>
                                <td width="5%">:</td>
                                <td>{{ $user->name }}</td>
                              </tr>
                              <tr>
                                <th>Jabatan</th>
                                <td>:</td>
                                <td>{{ $detail->position->name }}</td>
                              </tr>
                              <tr>
                                <th>Seksi Bidang</th>
                                <td>:</td>
                                <td>{{ $detail->division->name }}</td>
                              </tr>
                              <tr>
                                <th>Handphone</th>
                                <td>:</td>
                                <td>{{ $user->profile->phone_num === '' ? $user->profile->phone_num : '-'}}</td>
                              </tr>
                              <tr>
                                <th>Seksi Bidang</th>
                                <td>:</td>
                                <td>{{ $user->profile->address === '' ? $user->profile->address : '-' }}</td>
                              </tr>
                              <tr>
                                <th>Bergabung pada</th>
                                <td>:</td>
                                <td>{{ $detail->join_at }}</td>
                              </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table style="word-wrap:break-word" class="table {{ $style != 'excel' ? 'table-striped' : 'table-bordered'  }}" id="customers" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Hadir</th>
                                    <th>Sakit/Izin</th>
                                    <th>Terlambat</th>
                                    <th>Total Jam Kerja</th>
                                </tr>
                                @php
                                    $hadir = 0;
                                    $absen = 0;
                                    $telat = 0;
                                    $jamker = 0;
                                @endphp
                              @foreach ($data as $recap)
                                <tr>
                                  <td style="width: 25%; font-weight:bold;">{{ $recap->month }}</td>
                                  <td width="15%">{{ $recap->hadir }}</td>
                                  <td width="15%">{{ $recap->absen }}</td>
                                  <td width="15%">{{ $recap->telat }}</td>
                                  <td width="25%">{{ $recap->jamker }} jam</td>
                                </tr>
                                @php
                                    $hadir += $recap->hadir;
                                    $absen += $recap->absen;
                                    $telat += $recap->telat;
                                    $jamker += $recap->jamker;
                                @endphp
                              @endforeach
                              <tr>
                                <td>Total (1 tahun)</td>
                                <td>{{ $hadir }}</td>
                                <td>{{ $absen }}</td>
                                <td>{{ $telat }}</td>
                                <td>{{ $jamker }} jam</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>

</body>

</html>