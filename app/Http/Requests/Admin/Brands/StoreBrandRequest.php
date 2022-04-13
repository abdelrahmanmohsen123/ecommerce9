<?php

namespace App\Http\Requests\Admin\Brands;

use App\Http\Controllers\Admin\BrandsController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBrandRequest extends FormRequest
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
            // 'name'=>['required','max:32','unique:brands'],
            'name'=>['array:en,ar'],
            'name.en'=>['required','max:32','unique_translation:brands'],
            'name.ar'=>['required','max:32','unique_translation:brands'],

            'status'=>['required','in:'.implode(',',BrandsController::STATSES)],
            'image'=>['required','max:1024','mimes:'.implode(',',BrandsController::AVAILABLE_EXTENTION)],
            'width'=>['required_with:resize,true'],
            'height'=>['required_with:resize,true'],


        ];
    }
}
