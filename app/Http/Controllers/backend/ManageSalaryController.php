<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryRequest;
use App\Models\ManageSalaries;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Response;

class ManageSalaryController extends Controller
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
            $salary = ManageSalaries::latest()->get();
            return view('backend.salary.index', compact('salary'));
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
    public function store(SalaryRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new ManageSalaries();
                $data->user_id = Auth::user()->id;
                $data->working_days = $request->working_days;
                $data->tax = $request->tax;
                $data->gross_salary = $request->gross_salary;
                $save = $data->save();
            } else {
                $data = ManageSalaries::find($request->data_id);
                $data->working_days = $request->working_days;
                $data->tax = $request->tax;
                $data->gross_salary = $request->gross_salary;
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
            $singleData = ManageSalaries::find($id);
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
    public function salary_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = ManageSalaries::latest()->get();
            } else {
                $allData = ManageSalaries::where('working_days', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.salary.search', compact('allData'));
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
            $findiT = ManageSalaries::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
