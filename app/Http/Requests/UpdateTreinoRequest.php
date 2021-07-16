<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateTreinoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('treino_access');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo'     => [
                'string',
                'required',
            ],
            'dia'    => [
                'required',
            ],
            'descricao' => [
                'required',
            ],
            'exercicios.*' => [
                'string',
            ],
            'exercicios'   => [
                'required',
                'array',
            ],
        ];
    }
}
