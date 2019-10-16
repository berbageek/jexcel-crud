<?php

namespace App\Http\Requests\Mobil;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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

    public function prepareForValidation()
    {
        $data = json_decode(request('data'));
        $formattedData = [];

        foreach ($data as $index => $row) {
            $formattedData[] = [
                'id' => $row[0],
                'nama' => $row[1],
                'harga' => filter_var($row[2], FILTER_SANITIZE_NUMBER_INT),
                'posisi' => $index + 1,
            ];
        }

        $this->merge(['data' => $formattedData]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data.*.nama' => ['required'],
            'data.*.harga' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'data.*.nama.required' => 'Nama wajib diisi',
            'data.*.harga.required' => 'Harga wajib diisi',
        ];
    }
}
