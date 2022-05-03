<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $meta = UserMeta::latest()->get();
            return view('backend.user_meta.index', compact('meta'));
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
    public function store(Request $request)
    {
        try{
            
            if ($request->data_id == null) {
                $data = new UserMeta();
                $data->user_id = Auth::user()->id;
                $data->join_date = $request->join_date;
                $data->designation = $request->designation;
                $data->salary = $request->salary;
                $data->status = $request->status;
                $save = $data->save();
            } else {
                $data = UserMeta::find($request->data_id);
                $data->user_id = Auth::user()->id;
                $data->join_date = $request->join_date;
                $data->designation = $request->designation;
                $data->salary = $request->salary;
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
            $singleData = UserMeta::find($id);
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
    public function meta_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = UserMeta::latest()->get();
            } else {
                $allData = UserMeta::where('designation', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.user_meta.search', compact('allData'));
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
            $findiT = UserMeta::findOrFail($id);
            $data = $findiT->delete();
            return Response::json($data);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
