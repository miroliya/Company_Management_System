<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	function checkpermission($permission)
	{
		try {
			$user = Auth::user();
			$userpermission = explode(',', $user->user_permission);
			if (in_array($permission, $userpermission)) {
				//dd('hi');
			} else {
				return Redirect::to('/admin-dashboard')->send()->with('error_message', 'You Have No Permission For Access This Module');
			}
		} catch (Exception $e) {
			dd($e->getMessage());
		}
	}
}
