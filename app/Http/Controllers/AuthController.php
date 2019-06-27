<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(Auth $auth)
    {
        $this->response = new ResponseHelper;
        $this->helper = new GeneralHelper;
    }

    public function login(Request $request) {
        $email = $request->input('email');
        $pass = $request->input('password');

        $kader = Kader::where('email', $email)->first();
        if ($kader) {
            if (Hash::check($pass, $kader->password)) {
                $api_token = base64_encode(str_random(250));
                $kader->update([
                    'api_token' => $api_token
                ]);
    
                $response = $this->response->formatResponseWithPages("Login Success", ['kader' => $kader, 'api_token' => $api_token], $this->response->STAT_OK());
                $headers = $this->response->HEADERS_REQUIRED('POST');
                return response()->json($response, $this->response->STAT_OK(), $headers);
            } else {
                $response = $this->response->formatResponseWithPages("Password Salah", '', $this->response->STAT_BAD_REQUEST());
                $headers = $this->response->HEADERS_REQUIRED('POST');
                return response()->json($response, $this->response->STAT_BAD_REQUEST(), $headers); 
            }
        } else {
            $response = $this->response->formatResponseWithPages("Email tidak ditemukan", '', $this->response->STAT_BAD_REQUEST());
            $headers = $this->response->HEADERS_REQUIRED('POST');
            return response()->json($response, $this->response->STAT_BAD_REQUEST(), $headers); 
        }

    }
}
