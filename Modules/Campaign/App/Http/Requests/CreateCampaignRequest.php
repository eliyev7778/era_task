<?php

namespace Modules\Campaign\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'template_key' => 'required|string|max:255',
            'from_email' => 'nullable|email',
            'segment_id' => 'nullable|integer|exists:segments,id',
            'filter_json' => 'nullable|array',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
}
