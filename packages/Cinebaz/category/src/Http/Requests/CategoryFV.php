<?php

namespace Luova\Option\Http\Requests;

namespace Cinebaz\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryFV extends FormRequest
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
    public function rules(Request $request)
    {
        // dd($request);
        // dd($request->segment(2));
        return [
            'title_english' => 'required|max:191',
            'title_bangla' => 'required|max:191',
            'title_hindi' => 'required|max:191',
            'meta_title' => 'required',
            // 'slug' => 'required|max:191|unique:categories,slug,' . $request->get('id'),

        ];
    }
}
