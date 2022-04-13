<?php

namespace App\Http\Requests\Admin\Models;

use App\Http\Controllers\Admin\ModelsController;
use Illuminate\Foundation\Http\FormRequest;

class StoreModelRequest extends FormRequest
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
            'name.en'=>['required','max:32','unique_translation:models'],
            'name.ar'=>['required','max:32','unique_translation:models'],

            'status'=>['required','in:'.implode(',',ModelsController::STATSES)],
            'brand_id'=>['required','exists:brands,id'],
            'year'=>['required']
        ];
    }
}
