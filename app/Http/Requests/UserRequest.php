<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
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
            case 'admin.user.store':
                {
                    $rules['name'] = 'required';
                    $rules['email'] = 'required';
                    break;
                }
                default:
                break;
        }
        return $rules;
    }
}
