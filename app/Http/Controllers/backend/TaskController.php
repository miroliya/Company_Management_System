<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\UserMeta;
use Exception;
use Illuminate\Support\Facades\Auth;
use Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $task = Task::latest()->get();
            return view('backend.task.index', compact('task'));
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
    public function store(TaskRequest $request)
    {
        try{
            
            if ($request->data_id == null) {
                $data = new Task();
                $data->user_id = Auth::user()->id;
                $data->title = $request->title;
                $data->start_date = $request->start_date;
                $data->end_date = $request->end_date;
                $data->description = $request->description;
                $data->status = $request->status;
                $save = $data->save();
            } else {
                $data = Task::find($request->data_id);
                $data->user_id = Auth::user()->id;
                $data->title = $request->title;
                $data->start_date = $request->start_date;
                $data->end_date = $request->end_date;
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
            $singleData = Task::find($id);
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
    public function task_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = Task::latest()->get();
            } else {
                $allData = Task::where('title', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.task.search', compact('allData'));
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
            $findiT = Task::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
