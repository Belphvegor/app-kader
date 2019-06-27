<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Helpers\ResponseHelper;
use App\Models\OpenRegistration;

class OpenRegistrationController extends Controller
{
    public function __construct()
    {
        $this->response = new ResponseHelper;
        $this->helper = new GeneralHelper;
        $this->middleware('auth');
    }

    public function index()
    {
        $openRegis = OpenRegistration::all();
        if ($openRegis) {
            $response = $this->response->formatResponseWithPages("OK", $openRegis, $this->response->STAT_OK());
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
            'title'         =>  'required|max:150',
            'description'   =>  'required',
            'open_registration' =>  'required',
            'close_registration' =>  'required',
        ]);
        
        $code = $this->helper->codeRandom(4);

        $openRegis = new OpenRegistration;
        $openRegis->title = $request->title;
        $openRegis->description = $request->description;
        $openRegis->open_registration = $this->helper->generateIsoDate($request->open_registration);
        $openRegis->close_registration = $this->helper->generateIsoDate($request->close_registration);
        $openRegis->code = $code;
        $openRegis->save();

        $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $openRegis, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function detail($id)
    {
        $openRegis = OpenRegistration::findOrfail($id);

        if ($openRegis) {
            $response = $this->response->formatResponseWithPages("OK", $openRegis, $this->response->STAT_OK());
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
            'title'         =>  'required|max:150',
            'description'   =>  'required',
            'open_registration' =>  'required',
            'close_registration' =>  'required',
        ]);

        $openRegis = OpenRegistration::find($id);
        $openRegis->title = $request->title;
        $openRegis->description = $request->description;
        $openRegis->open_registration = $this->helper->generateIsoDate($request->open_registration);
        $openRegis->close_registration = $this->helper->generateIsoDate($request->close_registration);
        $openRegis->save();

        $response = $this->response->formatResponseWithPages("Berhasil Update Data", $openRegis, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function delete($id)
    {
        try {
            $openRegis = OpenRegistration::FindOrFail($id);
            $openRegis->forceDelete();
            $response = $this->response->formatResponseWithPages("Berhasil delete data", [], $this->response->STAT_OK());
            return response()->json($response, $this->response->STAT_OK());
        } catch (\Exception $e) {
            $response = $this->response->formatResponseWithPages("ID tidak ditemukan", [], $this->response->STAT_OK());
            return response()->json($response, $this->response->STAT_OK());
        }
    }
}
