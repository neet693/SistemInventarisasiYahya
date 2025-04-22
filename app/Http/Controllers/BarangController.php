<?php

namespace App\Http\Controllers;

use App\Exports\BarangsExport;
use App\Imports\BarangsImport;
use App\Models\Barang;
use App\Models\JenisPengadaan;
use App\Models\Kategorial;
use App\Models\Ruangan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $barangs = Barang::all();
        } else {
            $barangs = Barang::where('unit_id', $user->unit_id)->get();
        }
        // dd($barangs); // Debugging statement
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        // $this->authorize('create', Barang::class);
        $ruangans = Ruangan::all();
        $jenis_pengadaans = JenisPengadaan::all();
        $kategorials = Kategorial::all();
        $units = Unit::all();
        return view('barangs.create', compact('ruangans', 'jenis_pengadaans', 'kategorials', 'units'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Barang::class);

        if ($request->hasFile('gambar_barang')) {
            $path = $request->file('gambar_barang')->store('uploads');
        }
        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama' => $request->nama,
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'catatan' => $request->catatan,
            'ruangan_id' => $request->ruangan_id,
            'kategorial_id' => $request->kategori_id,
            'jenis_pengadaan_id' => $request->jenis_pengadaan_id,
            'unit_id' => $request->unit_id,
            'tahun' => $request->tahun,
            'kondisi' => $request->kondisi,
            // 'jumlah' => $request->jumlah,
            'sumber_peroleh' => $request->sumber_peroleh,
            'gambar_barang' => $path,
        ]);
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($kode_barang, Request $request)
    {
        // Cek apakah pengguna sudah login
        $user = auth()->user();

        // Jika sudah login, lewati form password
        if ($user) {
            // Cari barang berdasarkan kode_barang
            $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();

            // Generate QR Code berdasarkan kode barang
            $url = url('/barangs/' . $barang->kode_barang);

            // Generate QR Code
            $qrCode = Qrcode::format('svg')->size(200)->generate($url);

            // Kirimkan $barang dan $qrCode ke view
            return view('barangs.show', compact('barang', 'qrCode'));
        }

        // Cek apakah password telah dimasukkan jika pengguna belum login
        if ($request->isMethod('post')) {
            // Validasi password
            $request->validate([
                'password' => 'required',
            ]);

            // Cek password dari .env
            if ($request->password == env('BARANG_PASSWORD')) {
                // Cari barang berdasarkan kode_barang
                $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();

                // Generate QR Code berdasarkan kode barang
                $url = url('/barangs/' . $barang->kode_barang);

                // Generate QR Code
                $qrCode = Qrcode::format('svg')->size(200)->generate($url);

                // Kirimkan $barang dan $qrCode ke view
                return view('barangs.show', compact('barang', 'qrCode'));
            } else {
                // Jika password tidak sesuai, kembali ke form dengan error
                return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
            }
        }

        // Jika password belum dimasukkan, tampilkan form password
        return view('barangs.password_form', ['kode_barang' => $kode_barang]);
    }


    public function generateAndDownloadAllQRCodes()
    {
        $barangs = Barang::all();
        $zipFileName = 'qrcodes.zip';
        $zipPath = public_path($zipFileName);

        // Buat folder qrcodes kalau belum ada
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0777, true);
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($barangs as $barang) {
                $url = url('/barangs/' . $barang->kode_barang);
                $svg = QrCode::format('svg')->size(300)->generate($url);

                // Simpan sementara sebagai file SVG di public/qrcodes
                $safeFilename = str_replace('/', '-', $barang->kode_barang) . '.svg';
                $fullPath = public_path('qrcodes/' . $safeFilename);
                file_put_contents($fullPath, $svg);

                // Simpan ke ZIP dengan nama asli pakai struktur path (boleh pakai /)
                $zipFileName = $barang->kode_barang . '.svg';
                $zip->addFile($fullPath, $zipFileName);
            }
            $zip->close();

            // Opsional: Hapus semua QR setelah di-zip (biar bersih)
            foreach (glob(public_path('qrcodes/*.svg')) as $file) {
                unlink($file);
            }
            rmdir(public_path('qrcodes'));

            return response()->download($zipPath)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Gagal membuat file zip'], 500);
        }
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $ruangans = Ruangan::all();
        $jenis_pengadaans = JenisPengadaan::all();
        $kategorials = Kategorial::all();
        $units = Unit::all();
        return view('barangs.edit', compact('barang', 'ruangans', 'jenis_pengadaans', 'kategorials', 'units'));
    }

    public function update(Request $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        // Validasi input
        $validatedData = $request->validate([
            'kode_barang' => 'required|string',
            'nama' => 'required|string',
            'merk' => 'required|string',
            'tipe' => 'required|string',
            'unit_id' => 'required|exists:units,id',
            'tahun' => 'required|integer|min:1900|max:2099',
            'kondisi' => 'required|string',
            'kategorial_id' => 'required|exists:kategorials,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'jenis_pengadaan_id' => 'required|exists:jenis_pengadaans,id',
            // 'jumlah' => 'required|integer',
            'sumber_peroleh' => 'required|string',
            'catatan' => 'nullable|string',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Cek jika ada gambar baru yang diupload
        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar_barang) {
                Storage::delete($barang->gambar_barang);
            }
            // Simpan gambar baru
            $validatedData['gambar_barang'] = $request->file('gambar_barang')->store('uploads');
        }

        // Update barang dengan data yang telah divalidasi
        $barang->update($validatedData);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $this->authorize('destroy', Barang::class);
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function import()
    {
        Excel::import(new BarangsImport, request()->file('your_file'));

        return redirect('/')->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new BarangsExport, 'barangs.xlsx');
    }

    public function getByRuangan($ruangan_id)
    {
        return Barang::where('ruangan_id', $ruangan_id)->get();
    }

    public function printQr($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
        $url = url('/barangs/' . $barang->kode_barang);

        $svg = QrCode::format('svg')->size(300)->generate($url);

        return response($svg)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="qr-' . $barang->kode_barang . '.svg"');
    }
}
