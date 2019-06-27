<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Hash;

class KaderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $response;

    public function __construct()
    {
        $this->response = new ResponseHelper;
        $this->middleware('auth');
    }

    public function index()
    {
        $kader = Kader::all();
        if ($kader) {
            $response = $this->response->formatResponseWithPages("OK", $kader, $this->response->STAT_OK());
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
            'nik'               =>  'required|max:30',
            'nama'              =>  'required|max:30',
            'tempat_lahir'      =>  'required|max:30',
            'tanggal_lahir'     =>  'required',
            'jenis_kelamin'     =>  'required|max:10',
            'email'             =>  'required|max:100|unique:register,email',
            'profesi'           =>  'required|max:30',
            'asal'              =>  'required|max:30',
            'nohp'              =>  'required|max:15',
            'alamat'            =>  'required|max:190',
            'provinsi'          =>  'required|max:50',
            'kota'              =>  'required|max:50',
            'kecamatan'         =>  'required|max:30',
            'gol_darah'         =>  'required|max:3',
            'password'          =>  'required|min:6',
            'status'            =>  'required|max:20',
            'pos'               =>  'required|max:10',
        ]);

        $kader = new Kader;
        $kader->nik =  $request->nik;
        $kader->nama =$request->nama;
        $kader->tempat_lahir = $request->tempat_lahir;
        $kader->tanggal_lahir = $request->tanggal_lahir;
        $kader->jenis_kelamin = $request->jenis_kelamin;
        $kader->email = $request->email;
        $kader->password = Hash::make($request->password);
        $kader->gol_darah = $request->gol_darah;
        $kader->profesi = $request->profesi;
        $kader->nomor_telepon = $request->nohp;
        $kader->asal = $request->asal;
        $kader->status = $request->status;
        $kader->alamat = $request->alamat;
        $kader->provinsi = $request->provinsi;
        $kader->kota = $request->kota;
        $kader->kecamatan = $request->kecamatan;
        $kader->kode_pos = $request->pos;
        $kader->id_marhalah = $request->marhalah;
        $kader->save();

        $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $kader, $this->response->STAT_OK());
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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nik'               =>  'required|max:30',
            'nama'              =>  'required|max:30',
            'tempat_lahir'      =>  'required|max:30',
            'tanggal_lahir'     =>  'required',
            'jenis_kelamin'     =>  'required|max:10',
            'email'             =>  'required|max:100|unique:register,email',
            'profesi'           =>  'required|max:30',
            'asal'              =>  'required|max:30',
            'nohp'              =>  'required|max:15',
            'alamat'            =>  'required|max:190',
            'provinsi'          =>  'required|max:50',
            'kota'              =>  'required|max:50',
            'kecamatan'         =>  'required|max:30',
            'gol_darah'         =>  'required|max:3',
            'password'          =>  'required|min:6',
            'status'            =>  'required|max:20',
            'pos'               =>  'required|max:10',
            'marhala'           =>  'max:100',
        ]);

        $kader = Kader::findOrFail($id);
        $kader->nik               =  $request->nik;
        $kader->nama              =  $request->nama;
        $kader->tempat_lahir      =  $request->tempat_lahir;
        $kader->tanggal_lahir     =  $request->tanggal_lahir;
        $kader->jenis_kelamin     =  $request->jenis_kelamin;
        $kader->email             =  $request->email;
        $kader->gol_darah         =  $request->gol_darah;
        $kader->profesi           =  $request->profesi;
        $kader->nomor_telepon     =  $request->nohp;
        $kader->asal              =  $request->asal;
        $kader->status            =  $request->status;
        $kader->alamat            =  $request->alamat;
        $kader->provinsi          =  $request->provinsi;
        $kader->kota              =  $request->kota;
        $kader->kecamatan         =  $request->kecamatan;
        $kader->kode_pos          =  $request->pos;
        $kader->id_marhala        =  $request->marhala;
        if ($request->password != "") {
            $kader->password          = Hash::make($request->password);
        };
        $kader->save();

        $response = $this->response->formatResponseWithPages("Berhasil Update Data", $kader, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function delete($id)
    {
        $kader = Kader::destroy($id);
        $response = $this->response->formatResponseWithPages("Berhasil delete data", [], $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function trash()
    {
        $trash = Kader::onlyTrashed()->get();
        if ($trash) {
            $response = $this->response->formatResponseWithPages("OK", $trash, $this->response->STAT_OK());
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
        $kader = Kader::onlyTrashed()->find($request->id)->restore();
        $response = $this->response->formatResponseWithPages("Berhasil backup data", $kader, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function destroy(Request $request)
    {
        $kader = Kader::onlyTrashed()->find($request->id)->forceDelete();
        $response = $this->response->formatResponseWithPages("Berhasil delete data", $kader, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    /* ============================ pencarian ================================ */
    public function search(Request $request, Kader $kader)
    {
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $profesi = $request->input('profesi');
        $status = $request->input('status');
        $gol_darah = $request->input('gol_darah');
        $asal = $request->input('asal');
        $kecamatan = $request->input('kecamatan');
        $marhala = $request->input('marhala');
        $jenis_kelamin = $request->input('jenis_kelamin');

        $kader = $kader->newQuery();

        if ($request->has('nama')) {
            $kader->where('nama', 'like', "%{$nama}%");
        }
        if ($request->has('alamat')) {
            $kader->where('alamat', 'like', "%{$alamat}%");
        }
        if ($request->has('profesi')) {
            $kader->where('profesi', 'like', "%{$profesi}%");
        }
        if ($request->has('status')) {
            $kader->where('status', 'like', "%{$status}%");
        }
        if ($request->has('gol_darah')) {
            $kader->where('gol_darah', 'like', "%{$gol_darah}%");
        }
        if ($request->has('asal')) {
            $kader->where('asal', 'like', "%{$asal}%");
        }
        if ($request->has('kecamatan')) {
            $kader->where('kecamatan', 'like', "%{$kecamatan}%");
        }
        if ($request->has('marhala')) {
            $kader->where('id_marhala', 'like', "%{$marhala}%");
        }
        if ($request->has('jenis_kelamin')) {
            $kader->where('jenis_kelamin', 'like', "%{$jenis_kelamin}%");
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
