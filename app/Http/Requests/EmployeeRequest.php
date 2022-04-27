<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class EmployeeRequest extends FormRequest
{
    public static $rules = [];
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
                case 'admin.employee.store':
                    {
                        $rules['name'] = 'required';
                        $rules['first_name'] = 'required';
                        $rules['last_name'] = 'required';
                        $rules['last_name'] = 'required';
                        $rules['email'] = 'required';
                        $rules['phone'] = 'required';
                        $rules['gender'] = 'required';
                        $rules['address'] = 'required';
                        $rules['dob'] = 'required';
                        $rules['age'] = 'required';
                        $rules['user_status'] = 'required';
                        break;
                    }
                    default:
                    break;
            }
            return $rules;
    }
}
