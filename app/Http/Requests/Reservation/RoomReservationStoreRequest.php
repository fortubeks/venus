<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomReservationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'required_if:guest_id,null', 'string'],
            'amount' => ['nullable', 'numeric'],
            'address' => 'nullable|string|max:255',
            'email' => [Rule::requiredIf(!$this->has('phone') && !$this->has('guest_id')), Rule::unique('guests')->whereNot('email', null)->where('hotel_id', auth()->user()->hotel_id)],
            'phone' => [Rule::requiredIf(!$this->has('email') && !$this->has('guest_id')), Rule::unique('guests')->whereNot('phone', null)->where('hotel_id', auth()->user()->hotel_id)],
            'guest_id' => ['nullable', 'exists:guests,id'],
          ];
    }
}
