<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:191',
            'description' => 'required|min:5',
            'post_type' => 'required|' . Rule::in(['formation', 'stage']),
            'start_date' => 'date|nullable',
            'end_date' => 'date|nullable',
            'price' => 'numeric|nullable',
            'max_students' => 'numeric|nullable',
            'status' => Rule::in(['draft', 'published', 'trash']),
        ];
    }
}
