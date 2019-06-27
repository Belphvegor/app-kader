<?php

namespace App\Http\Controllers;

use App\Models\Marhalah;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;


class MarhalahController extends Controller
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

    public function index()
    {
        $marhalah = Marhalah::all();
        if ($marhalah) {
            $response = $this->response->formatResponseWithPages("OK", $marhalah, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_marhalah'       =>  'required|max:30',
        ]);

        $marhalah = new Marhalah;
        $marhalah->nama_marhalah = $request->nama_marhalah;
        $marhalah->save();

        $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $marhalah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function detail($id)
    {
        $marhalah = Marhalah::findOrfail($id);
        if ($marhalah) {
            $response = $this->response->formatResponseWithPages("OK", $marhalah, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_marhalah'       =>  'required|max:30',
        ]);

        $marhalah = Marhalah::find($id);
        $marhalah->nama_marhalah = $request->nama_marhalah;
        $marhalah->save();

        $response = $this->response->formatResponseWithPages("Berhasil Update Data", $marhalah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function delete($id)
    {
        $marhalah = Marhalah::destroy($id);
        $response = $this->response->formatResponseWithPages("Berhasil delete data", [], $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }
}
