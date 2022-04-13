<?php

namespace App\Http\Requests\Admin\Models;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\ModelsController;

class UpdateModelRequest extends FormRequest
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
            'name'=>['array:en,ar'],
            'name.en'=>['required','max:32'],
            'name.ar'=>['required','max:32'],

            'status'=>['required','in:'.implode(',',ModelsController::STATSES)],
            'year'=>['required'],
            'brand_id'=>['required','exists:brands,id']
        ];
    }
}
