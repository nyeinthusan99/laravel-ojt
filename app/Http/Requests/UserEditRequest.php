<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', Rule::unique("users","email")->ignore(Auth::user()->id)->whereNull('deleted_at')],
            'profile' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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
