<!DOCTYPE html>
<html lang="en">

<head>

    <title>KominfotikJT | {{ $title }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/cms.css')}}" rel="stylesheet">

    <!-- Data Tables -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- My CSS -->
    {{-- <link rel="stylesheet" href="{{asset('css/'. $style .'.css')}}"> --}}
    <link rel="stylesheet" href="{{ ($style === "" ? '' : 'css/'. $style .'.css') }}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    
                <div class="container-fluid">
                    <h5 class="mb-2">Rekap Absensi - 2022</h5>

                    <div class="table-responsive">
                        <table class="table"  width="100%" cellspacing="0">
                            <tr>
                                <th style="width: 20%">Nama</th>
                                <td>{{ $user->name }}</td>
                                <td rowspan="4" width="15%"><img class="img-profile"
                                    src="{{asset('img/undraw_profile_2.svg')}}"></td>
                              </tr>
                              <tr>
                                <th>Jabatan</th>
                                <td>{{ $detail->position->name }}</td>
                              </tr>
                              <tr>
                                <th>Seksi Bidang</th>
                                <td>{{ $detail->division->name }}</td>
                              </tr>
                              <tr>
                                <th>Handphone</th>
                                <td colspan="2">{{ $user->profile->phone_num === '' ? $user->profile->phone_num : '-'}}</td>
                              </tr>
                              <tr>
                                <th>Seksi Bidang</th>
                                <td colspan="2">{{ $user->profile->address === '' ? $user->profile->address : '-' }}</td>
                              </tr>
                              <tr>
                                <th>Bergabung pada</th>
                                <td colspan="2">{{ $detail->join_at }}</td>
                              </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                              <th style="border: none;"></th>
                              <th>Hadir</th>
                              <th>Sakit/Izin</th>
                              <th>Keterlambatan</th>
                              <th>Total Jam Kerja</th>
                            </thead>
                            <tbody>
                              @foreach ($data as $recap)
                                <tr>
                                  <th style="width: 20%">{{ $recap->month }}</th>
                                  <td>{{ $recap->hadir }}</td>
                                  <td>{{ $recap->absen }}</td>
                                  <td>{{ $recap->telat }}</td>
                                  <td>{{ $recap->jamker }} jam</td>
                                </tr>
                              @endforeach
                              <tr>
                                <th style="border:none;">Total (1 tahun)</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


    <!-- Own Script -->
    <script src="{{asset('js/script.js')}}"></script>

    <!-- google reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/chart-pie.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

</body>

</html>