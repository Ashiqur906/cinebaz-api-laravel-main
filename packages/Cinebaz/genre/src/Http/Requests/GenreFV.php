<?php

namespace Cinebaz\Genre\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GenreFV extends FormRequest
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
        // dd($request->get('id'));
        // dd($request->segment(2));
        return [
            'title_en' => 'required|max:191',
            'slug' => 'required|max:191|unique:genres,slug,' . $request->get('id'),
        ];
    }
}
