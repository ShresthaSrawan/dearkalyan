<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'type_id' => 'required|exists:post_types,id',
            'body' => 'required_unless:type_id,5',
            'tags' => 'required',
            'image' => 'required_if:type_id,2|image',
            'video' => 'required_if:type_id,3',
            'gallery' => 'required_if:type_id,4|min:1'
        ];
    }
}
