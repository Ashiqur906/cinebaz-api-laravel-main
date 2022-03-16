<?php



namespace Cinebaz\Tag\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class NotificationFV extends FormRequest
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
            'title_bn' => 'required|max:191',
            'title_en' => 'required|max:191',
            'title_hn' => 'required|max:191',
            'meta_title' => 'required',
            'slug' => 'required|max:191|unique:tags,slug,' . $request->get('id'),

        ];
    }
}
