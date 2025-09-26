<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SimpegUser;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override attemptLogin:
     * - cek user di SIMPEG
     * - validasi password
     * - sync ke Inventaris
     * - login pakai model Inventaris
     */
    protected function attemptLogin(Request $request)
    {
        $simpegUser = SimpegUser::where('email', $request->email)->first();

        if (!$simpegUser) {
            return false; // tidak ada di SIMPEG
        }

        if (!Hash::check($request->password, $simpegUser->password)) {
            return false; // password salah
        }

        // mapping role simpeg -> level_id inventaris
        $levelId = $this->mapRoleToLevel($simpegUser->role);

        // sinkron ke tabel user inventaris
        $user = User::updateOrCreate(
            ['email' => $simpegUser->email],
            [
                'simpeg_user_id' => $simpegUser->id ?? null,
                'nama'     => $simpegUser->nama ?? $simpegUser->name ?? 'User Tanpa Nama',
                'password' => $simpegUser->password,
                'level_id' => $levelId,
            ]
        );



        Auth::login($user, $request->filled('remember'));

        return true;
    }

    /**
     * Mapping role string (SIMPEG) -> level_id Inventaris
     */
    private function mapRoleToLevel($role)
    {
        return match (strtolower($role)) {
            'admin'   => 1,
            'kepala'  => 2,
            'hrd'     => 3, // kamu bisa ubah mappingnya kalau beda
            'teknisi' => 4,
            'laboran' => 5,
            default   => 5,
        };
    }

    /**
     * Setelah login berhasil → arahkan sesuai level
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->isAdmin() || $user->isKepala()) {
            return redirect()->route('home'); // dashboard admin
        }

        if ($user->isSarpras()) {
            return redirect()->route('home.unit', ['unitName' => $user->unit->nama]);
        }

        return redirect()->route('home'); // fallback
    }
}
