<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
                    'orders' => 'required|array|min:1',
                    'orders.*.media_id' => 'required|integer',
                    'orders.*.regular_price' => 'required',
                    'orders.*.discounted_price' => 'required',
                
            ];



    }

    public function messages()
    {

        return [
             
              'orders.*.media_id.required' => 'Orders id is required',
              'orders.*.media_id.integer' => 'Orders id must be integer',
              'orders.*.regular_price.required' => 'Regular price is required',
              'orders.*.discounted_price.required' => 'Discounted price is required',
          
        ];
    }
}
