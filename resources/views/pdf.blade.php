<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Attendance PDF</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
    
            h2 {
                text-align: center;
                font-size: 16px;
                margin-bottom: 15px;
            }
    
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
    
            .table thead th {
                background-color: #f2f2f2;
                font-weight: bold;
                border: 1px solid #ddd;
                padding: 5px;
                font-size: 12px;
            }
    
            .table tbody td {
                border: 1px solid #ddd;
                padding: 5px;
                font-size: 12px;
            }
    
            .table tbody tr:nth-child(odd) {
    background-color: #ffffff; /* Warna latar belakang untuk baris ganjil */
}

.table tbody tr:nth-child(even) {
    background-color:  #f2f2f2;/* Warna latar belakang untuk baris genap */
}
    
            .table th {
                text-align: center;
                padding: 5px;
            }
            .table td {
                padding: 5px;
            }
    
            .footer {
                text-align: center;
                font-size: 10px;
                margin-top: 15px;
            }
    
            @media print {
                .table th, .table td {
                    border: 1px solid #000;
                    padding: 4px;
                }
            }
        </style>
    </head>
<body>

    <h2>Rekap Presensi</h2>

    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="8%">No</th>
                <th scope="col" width="40%">Nama</th>
                <th scope="col" width="18%">Kelas</th>
                <th scope="col" width="30%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @forelse ($absen as $item)
            <tr>
                <td style="text-align: center">{{ $no++ }}</td>
                <td>{{ $item->siswa->nama_lengkap }}</td>
                <td>{{ $item->siswa->tempat_lahir }}</td>
                <td>{{$item->created_at}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada yang hadir</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
