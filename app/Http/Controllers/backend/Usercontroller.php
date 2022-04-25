<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Response;

class Usercontroller extends Controller
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
            $allData = User::latest()->get();
            return view('backend.user.index', compact('allData'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            if ($request->data_id == null) {
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->password = bcrypt($request->password);
                $data->user_status = $request->user_status;
                $save = $data->save();
            } else {
    
                $data = User::find($request->data_id);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
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

    public function user_search(Request $request)
    {
        try{
            $query = $request->get('query');
            if ($request->get('query') == null) {
                $allData = User::latest()->get();
            } else {
                $allData = User::where('email', 'LIKE', "%{$query}%")
                    ->latest()->get();
            }
            return view('backend.user.search', compact('allData'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
    public function user_addpermission($id)
    {
        try{
            $this->checkpermission(1);

            // if($id == 1)
            // {
            // 	return redirect()->route('admin.user.list')->with('error_message','This User Permission Are Not Changeable,Please Try Again With Anaother User.');
            // }
    
            // if($id == 2)
            // {
            // 	return redirect()->route('admin.user.list')->with('error_message','This User Permission Are Not Changeable,Please Try Again With Anaother User.');
            // }
    
            $allData2 = User::find($id);
            return view('backend.user.addpermission', compact('allData2'));
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }

    public function user_savepermissin(Request $request)
    {
        try{
            $findUser = User::find($request->role_id);
            $permission = explode(',', $findUser->user_permission);
            if (in_array($request->data_id, $permission)) {
                if ($findUser->user_permission == null) {
                } else {
                    $permissionarry = array_diff($permission, [$request->data_id]);
                    $permissionKey = implode(',', $permissionarry);
                    $findUser->user_permission = $permissionKey;
                    $findUser->update();
                    $data = "removed";
                }
            } else {
                $permissionKey = implode(',', $permission);
                $newpermissionKey = $permissionKey . ',' . $request->data_id;
                $findUser->user_permission = $newpermissionKey;
                $findUser->update();
                $data = "added";
            }
            return Response::json($data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }



    public function dashboard()
    {
        try{
            return view('backend.dashboard.dashboard');
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }



    public function login()
    {
        try{
            if (Auth::guard('web')->user() == null) {
                return view('backend.auth.login');
            } else {
                return redirect()->route('admin.dashboard')->with('success_message', 'You are already loged In');
            }
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }

    public function try_login(Request $request)
    {
        try{
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ]);
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                Auth::user()->save();
                return redirect()->route('admin.dashboard')->with('success_message', 'You are success fully loged In');
            } else {
                return redirect()->route('admin.login')->with('error_message', 'Invalid Username or Password');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function change_password()
    {
        try{
            return view('backend.user.auth.changepassword');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function change_password_try(Request $request)
    {
        try{
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
            ]);
    
            if ($request->new_password != $request->confirm_password) {
                return redirect()->back()->with('error_message', 'Password Not Matched,Please Try Again');
            }
            $user = User::find(Auth::user()->id);
    
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
    
                $user->update();
    
                return redirect()->route('admin.dashboard')->with('success_message', 'Successfully Changed Your Password');
            } else {
                return redirect()->back()->with('error_message', 'Your Old Password is Wrong');
            }
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }

    public function logout()
    {
        try{
            Auth::logout();
            Session::flash('success_message', 'Successfully Loged Out');
            return redirect()->route('admin.login');
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
