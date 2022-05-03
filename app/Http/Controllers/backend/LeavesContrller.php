<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeavesRequest;
use App\Models\Leaves;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Response;

class LeavesContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $leave = Leaves::latest()->get();
            return view('backend.leave.index', compact('leave'));
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
    public function store(LeavesRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new Leaves();
                $data->user_id = Auth::user()->id;
                $data->leave_type = $request->leave_type;
                $data->date_from = $request->date_from;
                $data->date_to = $request->date_to;
                $data->reason = $request->reason;
                $data->is_approved = $request->is_approved;
                $data->status = $request->status;
                $save = $data->save();
            } else {
                $data = Leaves::find($request->data_id);
                $data->user_id = Auth::user()->id;
                $data->leave_type = $request->leave_type;
                $data->date_from = $request->date_from;
                $data->date_to = $request->date_to;
                $data->reason = $request->reason;
                $data->is_approved = $request->is_approved;
                $data->status = $request->status;
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
            $singleData = Leaves::find($id);
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
    public function leave_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = Leaves::latest()->get();
            } else {
                $allData = Leaves::where('leave_type', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.leave.search', compact('allData'));
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
        //
    }
}
