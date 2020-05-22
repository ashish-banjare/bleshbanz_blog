<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';
        $id = $this->post ? ',' . $this->post->id : '';

        return $rules = [
            'title' => 'bail|required|max:255',
            'body' => 'bail|required|max:65000',
            'slug' => 'bail|required|max:255|unique:posts,slug' . $id,
            'excerpt' => 'bail|required|max:65000',
            'meta_description' => 'bail|required|max:65000',
            'meta_keywords' => 'bail|required|regex:' . $regex,
            'seo_title' => 'bail|required|max:255',
            'categories' => 'required',
            'tags' => 'nullable|regex:' . $regex,
        ];
    }
}
