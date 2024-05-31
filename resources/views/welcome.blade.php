<!DOCTYPE html>
<html>
<head>
    <title>Instascan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <style>
        .swal2-title-large {
            font-size: 2em; /* Memperbesar ukuran teks judul */
        }
        .swal2-content-large {
            font-size: 1.5em; /* Memperbesar ukuran teks konten */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('instascan.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Presensi Kehadiran Akhirussanah Angkatan 1</h1>
        <div class="row">
            <div class="col-3">
                <div class="card bg-white p-2 rounded-3 border-0 shadow">
                    <div class="wrapper" woi>
                        <div class="scanner"></div>
                        <video id="preview"></video>
                    </div>
                    <form action="{{route('absen.store')}}" method="POST" id="form">
                        @csrf
                        <input type="hidden" name="siswa_id" id="siswa_id">
                    </form>
                </div>
            </div>
            <div class="col-9">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" width="15%">No</th>
                            <th scope="col" width="55%"">Nama</th>
                            <th scope="col" width="30%"">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                            $no++;
                        @endphp
                        @forelse ($absen as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->siswa->nama}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada yang hadir</td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        scanner.addListener('scan', function(c){
            document.getElementById('siswa_id').value = c;
            document.getElementById('form').submit();
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    @if (session('alert'))
    <script>
        Swal.fire({
            icon: '{{ session('alert.type') }}',
            title: '{{ session('alert.title') }}',
            text: '{{ session('alert.message') }}',
            showConfirmButton: false,
            timer: 5000,
            height: 1000,
        });
    </script>
@endif


</body>
</html>
