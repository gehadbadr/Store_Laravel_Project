<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id'=> [
                'required',
                'integer'
            ],
             'name'=> [
                'required',
                'string'
            ],
            'slug'=> [
                'required',
                'string'
            ],
            'description'=> [
                'required',
                'string'
            ],  
            'mini_desc'=> [
                'required',
                'string',
                'max:500'
            ],
            'mainImage'=> [
                'nullable',
                'max:1024',
             //   'mimes:jpg,jpeg,png'
            ],
            'image'=> [
                'nullable',
                'max:1024',
             //   'mimes:jpg,jpeg,png'
            ],
            'status'=> [
                'nullable'
            ],
            'trending'=> [
                'nullable'
            ],
            'price'=> [
                'required',
                'between:0,9999999999.99'
            ],
            'discount_price'=> [
                'nullable',
                'between:0,9999999999.99'
            ],
            'qty'=> [
                'nullable',
                'integer'
            ],
            'meta_title'=> [
                'required',
                'string',
                'max:225'
            ],
            'meta_keyword'=> [
                'required',
                'string'
            ],
            'meta_desc'=> [
                'required',
                'string'
            ]
        ];
    }
}
