<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer as BaconQrCodeWriter;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;

class DoubleAutenticationController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $user = Auth::user();
        $urlQr = $this->verificar2fact($user->id);
        return view('auth.fact2', compact('urlQr', 'user'));
    }

    /**
     * Permite verificar si un usuario ya tiene su 2Fact
     *
     * @param integer $user_id
     * @return string
     */
    public function verificar2fact($user_id): string
    {
        $check2Fact = User::where([
            ['id', '=', $user_id],
            ['token_google', '!=', null],
            ['activar_2fact', '=', '1'],
        ])->first();
        
        $result = '';
        if ($check2Fact == null) {
            User::where('id', '=', $user_id)->update([
                'token_google' => (new Google2FA)->generateSecretKey(),
                //'activar_2fact' => "1"
            ]);
            $user = User::find($user_id);
            $result = $this->createUserUrlQR($user);
        }
        return $result;
    }

    /**
     * Permite general el codigo QR para el codigo
     *
     * @param object $user
     * @return void
     */
    public function createUserUrlQR($user)
    {
        $bacon = new BaconQrCodeWriter(new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        ));

        $data = $bacon->writeString(
            (new Google2FA)->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $user->token_google
            ), 'utf-8');
        $code = 'data:image/png;base64,' . base64_encode($data);
        
        $user->update(['QR_code' => $code]);

        return $code;
    }

    /**
     * Permite verificar 2fact del login
     *
     * @param Request $request
     * @return void
     */
    public function checkCodeLogin(Request $request)
    {
        $validate = $request->validate([
            'code' => 'required|numeric'
        ]);
        if ($validate) {
            
            if ($this->checkCode(Auth::id(), $request->code)) {
                session(['2fact' => 1]);
                Auth::user()->update(['activar_2fact' => '1']);
                return redirect()->route('dashboard')->with('success', 'Verificación correcta');
            }
        
            return back()->with('danger', 'Código de verificación incorrecto');
        }
    }

    /**
     * Permite verificar si el codigo Es correcto
     *
     * @param integer $user_id
     * @param integer $code
     * @return boolean
     */
    public function checkCode($user_id, $code): bool
    {
        $user = User::find($user_id);
        $result = false;
        if ((new Google2FA())->verifyKey($user->token_google, $code)) {
            $result = true;
        }
        return $result;
    }

    public function removeAuth(Request $request)
    {
        try {
            $user = User::find($request->userId)->update([
                'token_google' => null,
                'activar_2fact' => "0",
                'QR_code' => null
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            
            Log::error('DoubleAutenticationController - removeAuth -> Error: '.$th);
            return response()->json(['success' => false]);
        }
    }
}
