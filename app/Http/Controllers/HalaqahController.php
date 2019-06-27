<?php

namespace App\Http\Controllers;

use App\Models\Halaqah;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;


class HalaqahController extends Controller
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
        $halaqah = Halaqah::all();
        if ($halaqah) {
            $response = $this->response->formatResponseWithPages("OK", $halaqah, $this->response->STAT_OK());
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
            'halaqah'       =>  'required|max:30',
            'murabbi'       =>  'required|max:30',
            'naqib'         =>  'required|max:30',
            'sekretaris'    =>  'required|max:30',
            'bendahara'     =>  'required|max:30',
            'marhala'       =>  'required|max:30',
        ]);

        $halaqah = Halaqah::create([
            'nama_halaqah'  =>  $request->halaqah,
            'murabbi'       =>  $request->murabbi,
            'naqib'         =>  $request->naqib,
            'sekretaris'    =>  $request->sekretaris,
            'bendahara'     =>  $request->bendahara,
            'id_marhala'       =>  $request->marhala,
        ]);

        $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $halaqah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function detail($id)
    {
        // $halaqah = Halaqah::findOrfail($id);
        $halaqah = Tarbiyah_Detail::findOrfail($id)->kaders()->get();

        if ($halaqah) {
            $response = $this->response->formatResponseWithPages("OK", $halaqah, $this->response->STAT_OK());
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
            'halaqah'       =>  'required|max:30',
            'murabbi'       =>  'required|max:30',
            'naqib'         =>  'required|max:30',
            'sekretaris'    =>  'required|max:30',
            'bendahara'     =>  'required|max:30',
            'marhala'       =>  'required|max:30',
        ]);

        $halaqah = Halaqah::find($id)->update([
            'nama_halaqah'  =>  $request->halaqah,
            'murabbi'       =>  $request->murabbi,
            'naqib'         =>  $request->naqib,
            'sekretaris'    =>  $request->sekretaris,
            'bendahara'     =>  $request->bendahara,
            'id_marhala'       =>  $request->marhala,
        ]);

        $response = $this->response->formatResponseWithPages("Berhasil Update Data", $halaqah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function delete($id)
    {
        $halaqah = Halaqah::destroy($id);
        $response = $this->response->formatResponseWithPages("Berhasil delete data", $halaqah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function trash()
    {
        $halaqah = Halaqah::onlyTrashed()->get();
        if ($halaqah) {
            $response = $this->response->formatResponseWithPages("OK", $halaqah, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function restore(Request $request)
    {
        $halaqah = Halaqah::onlyTrashed()->find($request->id)->restore();
        $response = $this->response->formatResponseWithPages("Berhasil delete data", $halaqah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function destroy(Request $request)
    {
        $halaqah = Halaqah::onlyTrashed()->find($request->id)->forceDelete();
        $response = $this->response->formatResponseWithPages("Berhasil delete data", $halaqah, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }
    /* ============================ pencarian ================================ */
    public function search(Request $request, Halaqah $kader)
    {
        $nama = $request->input('halaqah');

        $kader = $kader->newQuery();

        if ($request->has('halaqah')) {
            $kader->where('nama_halaqah', 'like', "%{$nama}%");
        }

        if ($kader) {
            $response = $this->response->formatResponseWithPages("OK", $kader->paginate(20), $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }
}
