<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Response;

class EmployeeController extends Controller
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
            $employee = User::where('first_name', '!=', null)->get();
            return view('backend.employee.index', compact('employee'));
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
    public function store(EmployeeRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new User();
                $data->name = $request->name;
                $data->first_name = $request->first_name;
                $data->last_name = $request->last_name;
                if($request->file('image')){
                    $file= $request->file('image');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('/image'), $filename);
                    $data['image']= $filename;
                }
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->gender = $request->gender;
                $data->address = $request->address;
                $data->age = $request->age;
                $data->dob = $request->dob;
                $data->password = bcrypt($request->password);
                $data->user_status = $request->user_status;
                $save = $data->save();
            } else {
    
                $data = User::find($request->data_id);
                $data->name = $request->name;
                $data->first_name = $request->first_name;
                $data->last_name = $request->last_name;
                if($request->file('image')){
                    $file= $request->file('image');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('/image'), $filename);
                    $data['image']= $filename;
                }
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->gender = $request->gender;
                $data->address = $request->address;
                $data->age = $request->age;
                $data->dob = $request->dob;
                if ($request->password != null) {
                    $data->password = bcrypt($request->password);
                }
                $data->user_status = $request->user_status;
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
            $singleData = User::find($id);
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

    public function employee_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $employee = User::where('first_name', '!=', null)->get();
            } else {
                $employee = User::where('name', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.employee.search', compact('employee'));
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
            $findiT = User::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
