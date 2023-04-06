<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use function dd;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'unique:posts'],
            'content'=>['required', 'string','min:15'],
            'preview_image'=>['required', 'image'],
            'main_image'=>['required', 'image'],
            'category_id'=>['required', 'integer', 'exists:categories,id'],
            'tag_ids'=>['nullable', 'array'],
            'tag_ids*'=>['nullable','integer', 'exists:tags,id']
        ];
    }

    public function messages():array
    {
        return [
            'title.required'=>'Это поле необходимо для заполнения',
            'title.string'=>'Данные должны соответствовать строковому типу'
        ];
    }


}
