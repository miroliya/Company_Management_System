<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Response;

class EventController extends Controller
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
            $event = Event::latest()->get();
            return view('backend.event.index', compact('event'));
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
    public function store(EventRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new Event();
                $data->user_id = Auth::user()->id;
                $data->date = $request->date;
                $data->event = $request->event;
                $data->description = $request->description;
                $data->status = $request->status;
                $save = $data->save();
            } else {
                $data = Event::find($request->data_id);
                $data->user_id = Auth::user()->id;
                $data->date = $request->date;
                $data->event = $request->event;
                $data->description = $request->description;
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
            $singleData = Event::find($id);
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
    public function event_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = Event::latest()->get();
            } else {
                $allData = Event::where('event', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.event.search', compact('allData'));
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
            $findiT = Event::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
