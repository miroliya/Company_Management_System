<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(){
        $task = Task::where('status', '=', 1)->orWhere('user_id', '=', Auth::user()->id)->count();
        return view('backend.report.report', compact('task'));
    }
}
