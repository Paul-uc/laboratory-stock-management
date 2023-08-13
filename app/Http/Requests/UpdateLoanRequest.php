<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'category_id' => 'required',
            'user_id' => 'required',
            'username' => 'required|string',
            'email' => 'required|email',
            'phoneNumber' => 'required|string',
            'reason' => 'required|string',
            'supervisorName' => 'required|string',
            'startLoanDate' => 'required|date',
            'estReturnDate' => 'required|date',
            'termsAndCondition' => 'required',
        ];
    }
}
