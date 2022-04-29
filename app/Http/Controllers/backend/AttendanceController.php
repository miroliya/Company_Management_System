<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $this->checkpermission(1);
            $attendance = Attendance::latest()->get();
            return view('backend.attendance.index', compact('attendance'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new Attendance();
                $data->user_id = Auth::user()->id;
                $data->date = $request->date;
                $data->username = $request->username;
                $data->attendance = $request->attendance;
                $data->in = $request->in;
                $data->out = $request->out;
                $save = $data->save();
            } else {
                $data = Attendance::find($request->data_id);
                $data->user_id = Auth::user()->id;
                $data->date = $request->date;
                $data->username = $request->username;
                $data->attendance = $request->attendance;
                $data->in = $request->in;
                $data->out = $request->out;
                $save = $data->update();
            }
            return Response::json($data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $singleData = Attendance::find($id);
            return Response::json($singleData);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function attendance_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = Attendance::latest()->get();
            } else {
                $allData = Attendance::where('username', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.attendance.search', compact('allData'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $findiT = Attendance::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
