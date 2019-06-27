<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Helpers\ResponseHelper;
use App\Models\OpenRegistration;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->helper = new GeneralHelper;
        $this->response = new ResponseHelper;
    }

    public function registrasi(Request $request)
    {
        $kode = $request->input('kode');

        $event = OpenRegistration::where('code', $kode)->first();

        if ($event) {
            // $now = new \MongoDB\BSON\UTCDateTime(new \DateTime('now'));
            $now = date('Y-m-d H:i:s');

            if ($now >= $event->open_registration && $now <= $event->close_registration) {
                $response = $this->response->formatResponseWithPages("OK", $event, $this->response->STAT_OK());
                $headers = $this->response->HEADERS_REQUIRED('GET');
                return response()->json($response, $this->response->STAT_OK(), $headers);
            } else {
                $headers = $this->response->HEADERS_REQUIRED('GET');
                $response = $this->response->formatResponseWithPages("Masa aktif kode yang Anda gunakan telah habis", [], $this->response->STAT_NOT_FOUND());
                return response()->json($response, $this->response->STAT_OK(), $headers);
            }
        } else {
            $response = $this->response->formatResponseWithPages("Kode yang Anda masukkan tidak valid", '', $this->response->STAT_NOT_FOUND());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        }
    }

    public function store(Request $request, $id)
    {
        $event = OpenRegistration::findOrfail($id);
        $now = date('Y-m-d H:i:s');

        $validator = \Validator::make($request->all(), [
            'nik'           => 'required|numeric|unique:kaders,nik',
            'name'          => 'required|max:50',
            'place_birth'   => 'required|max:50',
            'date_birth'    => 'required|date',
            'gender'        => 'required|max:10',
            'email'         => 'required|email|max:100|unique:kaders,email',
            'job'           => 'required|max:30',
            'phone'         => 'required|max:20|unique:kaders,phone',
            'address'       => 'required|max:190',
            'province'      => 'required|max:50',
            'city'          => 'required|max:50',
            'district'      => 'required|max:30',
            'village'       => 'required|max:30',
            'blood_type'    => 'required|max:3',
            'zip_code'      => 'required|max:10',
        ], $this->helper->RegisterValidationMessageCustom());

        if ($validator->fails()) {
            $headers = $this->response->HEADERS_REQUIRED('POST');
            $response = $this->response->formatResponseWithPages("Error Validations", $validator->errors(), $this->response->STAT_UNPROCESSABLE_ENTITY());
            return response()->json($response, $this->response->STAT_OK(), $headers);
        }

        if ($now >= $event->open_registration && $now <= $event->close_registration) {
            $tarbiyah = new Kader;
            $tarbiyah->nik = $request->nik;
            $tarbiyah->name = $request->name;
            $tarbiyah->place_birth = $request->place_birth;
            $tarbiyah->date_birth = $request->date_birth;
            $tarbiyah->gender = $request->gender;
            $tarbiyah->email = $request->email;
            $tarbiyah->job = $request->job;
            $tarbiyah->address = $request->address;
            $tarbiyah->phone = $this->helper->formatNumberPhone($request->phone);
            $tarbiyah->province = (int)$request->province;
            $tarbiyah->city = (int)$request->city;
            $tarbiyah->district = (int)$request->district;
            $tarbiyah->village = (int)$request->village;
            $tarbiyah->blood_type = $request->blood_type;
            $tarbiyah->password = Hash::make("secret");
            $tarbiyah->zip_code = $request->zip_code;
            $tarbiyah->status = $request->status;
            $tarbiyah->save();

            $headers = $this->response->HEADERS_REQUIRED('POST');
            $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $tarbiyah, $this->response->STAT_OK());
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('POST');
            $response = $this->response->formatResponseWithPages("Masa aktif kode yang Anda gunakan telah habis", '', $this->response->STAT_BAD_REQUEST());
            return response()->json($response, $this->response->STAT_BAD_REQUEST(), $headers);
        }
    }

    public function detail($id)
    {
        try {
            $peserta = Kader::findOrfail($id);
            $response = $this->response->formatResponseWithPages("OK", $peserta, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } catch (\Exception $e) {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }
}
