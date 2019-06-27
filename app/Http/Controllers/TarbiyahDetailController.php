<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\Tarbiyah_Detail;


class TarbiyahDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->response = new ResponseHelper;
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $datas = Tarbiyah_Detail::all();
    //     if ($datas) {
    //         $response = $this->response->formatResponseWithPages("OK", $datas, $this->response->STAT_OK());
    //         $headers = $this->response->HEADERS_REQUIRED('GET');
    //         return response()->json($response, $this->response->STAT_OK(), $headers);
    //     } else {
    //         $headers = $this->response->HEADERS_REQUIRED('GET');
    //         $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
    //         return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
    //     }
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_halaqah'    =>  'required',
            'id_user'       =>  'required',
        ]);

        $tarbiyah = Tarbiyah_Detail::create([
            'id_halaqah'    =>  $request->id_halaqah,
            'id_user'       =>  $request->id_user,
        ]);

        $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $tarbiyah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function detail($id)
    {
        $detail = Kader::findOrfail($id);
        if ($detail) {
            $response = $this->response->formatResponseWithPages("OK", $detail, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load detail data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function delete($id)
    {
        $delete = Tarbiyah_Detail::destroy($id);
        $response = $this->response->formatResponseWithPages("Berhasil delete data", $delete, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    //
}
