<?php

namespace Modules\Campaign\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestSendCampaignRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
    public function authorize(): bool
    {
        return true;
    }
}
