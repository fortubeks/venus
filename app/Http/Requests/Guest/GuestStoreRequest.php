<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuestStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'email' => ['required_if:phone,null', Rule::unique('guests')->whereNot('email',null)->where('hotel_id',auth()->user()->hotel_id) ],
            'phone' => ['required_if:email,null', Rule::unique('guests')->whereNot('phone',null)->where('hotel_id',auth()->user()->hotel_id) ],
            'address' => 'nullable|string|max:255'
        ];
    }
}
