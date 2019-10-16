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
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);

        foreach ($data as $row) {
            $formattedData[] = [
                'nama' => $row[0],
                'harga' => $formatter->parseCurrency($row[1], $curr) ?: null,
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
