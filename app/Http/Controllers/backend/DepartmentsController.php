<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $department = Department::latest()->get();
            return view('backend.department.index', compact('department'));
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
    public function store(DepartmentRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new Department();
                $data->user_id = Auth::user()->id;
                $data->name = $request->name;
                $data->status = $request->status;
                $save = $data->save();
            } else {
                $data = Department::find($request->data_id);
                $data->user_id = Auth::user()->id;
                $data->name = $request->name;
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
            $singleData = Department::find($id);
            return Response::json($singleData);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function department_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = Department::latest()->get();
            } else {
                $allData = Department::where('name', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.department.search', compact('allData'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $findiT = Department::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
