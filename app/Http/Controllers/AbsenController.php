<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
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
                'tanggal' => date('Y-m-d')
            ]);
            $pp = Siswa::find($request->siswa_id);
            return redirect('/')->with('alert', [
                'type' => 'success',
                'title' => 'Selamat Datang ' . $pp->nama_lengkap,
                'message' => 'Silahkan masuk, terima kasih'
            ]);
        }
    }
}
