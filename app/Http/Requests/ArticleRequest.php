<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;

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
        $item = Article::where('id', (int)request()->id)->get();

        $rules = [
            'slug' => 'required|unique:articles|regex:/[a-zA-Z0-9_-]/',
            'title'  => 'required|min:5|max:100',
            'short_description' => 'required|max:255',
            'description'  => 'required',
        ];

        if ($item->count() !== 0 && $item[0]->slug === request()->slug) {
            $rules = [
                'slug' => 'required|regex:/[a-zA-Z0-9_-]/',
                'title'  => 'required|min:5|max:100',
                'short_description' => 'required|max:255',
                'description'  => 'required',
            ];
        }

        return $rules;
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
      return [
        'slug.not_regex'  => 'The field must consist only of Latin characters, numbers and symbols of dash and underscore.',
      ];
    }
}
