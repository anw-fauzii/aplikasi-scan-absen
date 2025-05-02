<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function create()
    {
        $absen = Absen::all();
        $data = ['title' => 'Presesnsi Kehadiran'];
        $pdf = Pdf::loadView('pdf', compact('data', 'absen'));
        return $pdf->download('document.pdf');
    }

    public function store(Request $request)
    {
        $cek = Absen::where([
            'siswa_id' => $request->siswa_id,
            'tanggal' => date('Y-m-d')
        ])->first();

        if ($cek) {
            return redirect('/')->with('alert', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Anda sudah absen'
            ]);
        } else {
            Absen::create([
                'siswa_id' => $request->siswa_id,
                'tanggal' => date('Y-m-d'),
                'role' => $request->role // Menyimpan pilihan 'role'
            ]);

            $pp = Siswa::find($request->siswa_id);
            return redirect('/')->with('alert', [
                'type' => 'success',
                'title' => 'Selamat Datang ' . $request->role . ' ' . $pp->nama_lengkap,
                'message' => 'Silahkan masuk, terima kasih'
            ]);
        }
    }
}
