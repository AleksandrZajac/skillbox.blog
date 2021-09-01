<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
            'slug' => 'required|unique:articles,slug,'. $this->id .'|not_regex:/[а-яА-Я]/|alpha_dash',
            'title'  => 'required|min:5|max:100',
            'short_description' => 'required|max:255',
            'description'  => 'required',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
      return [
        'slug.not_regex'  => 'The field must consist only of Latin characters.',
      ];
    }
}
