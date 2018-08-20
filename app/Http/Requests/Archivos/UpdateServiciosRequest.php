<?php
namespace App\Http\Requests\Archivos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiciosRequest extends FormRequest
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
            'detalle' => 'required',
            'precio' => 'required',
         
        ];
    }
}
