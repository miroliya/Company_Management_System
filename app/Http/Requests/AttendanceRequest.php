<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AttendanceRequest extends FormRequest
{
    public static  $rules = [];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Self::$rules;
        switch (Route::currentRouteName()) {
            case 'admin.attendance.store':
                {
                    $rules['date'] = 'required';
                    $rules['username'] = 'required'; 
                    $rules['attendance'] = 'required'; 
                    break;
                }
                default:
                break;
        }
        return $rules;
    }
}
