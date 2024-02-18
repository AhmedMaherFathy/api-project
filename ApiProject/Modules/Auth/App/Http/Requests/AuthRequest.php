<?php

namespace Modules\Auth\App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'=>'required|min:3|max:255',
            'email'=>'required|unique:users|email|min:5|max:255',
            'password'=>'required|min:8|max:255',
            'image' =>'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
    
    $errors = $validator->errors();

    $response = response()->json([
        'message' => 'Invalid data send',
        'details' => $errors->messages(),
    ], 422);
    throw new HttpResponseException($response);
    }
}
