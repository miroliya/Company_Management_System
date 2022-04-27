<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            case 'admin.task.store':
                {
                    $rules['title'] = 'required';
                    $rules['start_date'] = 'required';
                    $rules['end_date'] = 'required';
                    $rules['description'] = 'required'; 
                    $rules['status'] = 'required'; 
                    break;
                }
                default:
                break;
        }
        return $rules;
    }
}
