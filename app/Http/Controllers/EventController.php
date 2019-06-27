<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Helpers\ResponseHelper;

class EventController extends Controller
{
    public function __construct()
    {
        $this->response = new ResponseHelper;
        $this->helper = new GeneralHelper;
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::all();
        if ($events) {
            $response = $this->response->formatResponseWithPages("OK", $events, $this->response->STAT_OK());
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
            'location'        =>  'required|max:150',
            'description'   =>  'required',
            'open_registration' =>  'required',
            'close_registration' =>  'required',
        ]);
        
        $code = $this->helper->codeRandom(4);

        $events = new Event;
        $events->title = $request->title;
        $events->location = $request->location;
        $events->description = $request->description;
        $events->open_registration = $this->helper->generateIsoDate($request->open_registration);
        $events->close_registration = $this->helper->generateIsoDate($request->close_registration);
        $events->code = $code;
        $events->save();

        $response = $this->response->formatResponseWithPages("Berhasil Menambah Data", $events, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function detail($id)
    {
        $events = Event::findOrfail($id);

        if ($events) {
            $response = $this->response->formatResponseWithPages("OK", $events, $this->response->STAT_OK());
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
            'location'      =>  'required|max:150',
            'description'   =>  'required',
            'open_registration' =>  'required',
            'close_registration' =>  'required',
        ]);

        $events = Event::find($id);
        $events->title = $request->title;
        $events->location = $request->location;
        $events->description = $request->description;
        $events->open_registration = $this->helper->generateIsoDate($request->open_registration);
        $events->close_registration = $this->helper->generateIsoDate($request->close_registration);
        $events->save();

        $response = $this->response->formatResponseWithPages("Berhasil Update Data", $events, $this->response->STAT_OK());
        return response()->json($response, $this->response->STAT_OK());
    }

    public function delete($id)
    {
        try {
            $events = Event::FindOrFail($id);
            $events->forceDelete();
            $response = $this->response->formatResponseWithPages("Berhasil delete data", [], $this->response->STAT_OK());
            return response()->json($response, $this->response->STAT_OK());
        } catch (\Exception $e) {
            $response = $this->response->formatResponseWithPages("ID tidak ditemukan", [], $this->response->STAT_OK());
            return response()->json($response, $this->response->STAT_OK());
        }
    }
}
