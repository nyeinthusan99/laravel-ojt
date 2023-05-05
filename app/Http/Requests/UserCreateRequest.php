<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $date = new Carbon();
        $before = $date->subYears(16)->format('Y/m/d');
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique("users","email")->whereNull('deleted_at')],
            'password' => ['required', 'min:8', 'same:confirmPassword',],
            'confirmPassword' => ['required'],
            //'profile' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'type' => ['required'],
            'phone' => ['max:20'],
            'address' => ['max:255'],
            'dob' =>'nullable|date|before:' . $before
        ];
    }

    public function messages()
    {
        return [
            'dob.before' => "Your age must be greater than 16",
        ];
    }
}
