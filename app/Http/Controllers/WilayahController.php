<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Helpers\ResponseHelper;
use App\Models\Wilayah\Provinsi;
use App\Models\Wilayah\Kabupaten;
use App\Models\Wilayah\Kecamatan;
use App\Models\Wilayah\Kelurahan;

class WilayahController extends Controller
{
    public function __construct()
    {
        $this->response = new ResponseHelper;
        $this->helper = new GeneralHelper;
    }

    public function provinsi(){
        $provinsi = Provinsi::orderBy('name')->get();

        
        if ($provinsi) {
            $data = [];
            foreach ($provinsi as $p) {
                $data[] = [
                    'value' => $p->id,
                    'caption' => $p->name
                ];
            }

            $response = $this->response->formatResponseWithPages("OK", $data, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function kabupaten(Request $r){
        $kabupaten = Kabupaten::where('province_id', (int)$r->province_id)->orderBy('name')->get();
        
        if ($kabupaten) {
            $data = [];
            foreach ($kabupaten as $k) {
                $data[] = [
                    'value' => $k->id,
                    'caption' => $k->name
                ];
            }

            $response = $this->response->formatResponseWithPages("OK", $data, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function kecamatan(Request $r){
        $kecamatan = Kecamatan::where('city_id', (int)$r->city_id)->orderBy('name')->get();
        if ($kecamatan) {
            $data = [];
            foreach ($kecamatan as $k) {
                $data[] = [
                    'value' => $k->id,
                    'caption' => $k->name
                ];
            }

            $response = $this->response->formatResponseWithPages("OK", $data, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }

    public function kelurahan(Request $r){
        $kelurahan = Kelurahan::where('district_id', (int)$r->district_id)->orderBy('name')->get();
        if ($kelurahan) {
            $data = [];
            foreach ($kelurahan as $k) {
                $data[] = [
                    'value' => $k->id,
                    'caption' => $k->name
                ];
            }

            $response = $this->response->formatResponseWithPages("OK", $data, $this->response->STAT_OK());
            $headers = $this->response->HEADERS_REQUIRED('GET');
            return response()->json($response, $this->response->STAT_OK(), $headers);
        } else {
            $headers = $this->response->HEADERS_REQUIRED('GET');
            $response = $this->response->formatResponseWithPages("Failed to load data", [], $this->response->STAT_NOT_FOUND());
            return response()->json($response, $this->response->STAT_NOT_FOUND(), $headers);
        }
    }
}
