<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    private function default() {
        return [
            'name' => ['required', 'max:35', 'min:3']
        ];
    }

    private function store() {
        $required = $this->default();
        //Add unique name category
        array_push($required['name'],'unique:categories,name');
        return  $required;
    }


    private function update() {
        $required = $this->default();
        //Add unique name category by id
        array_push($required['name'],'unique:categories,name,'.$this->category->id.'');
        return  $required;
    }

    public function rules()
    {
        switch ($this->method()) {
            case "POST" :
                $validate = $this->store();
                break;
            case "PATCH":
            case "PUT" :
                $validate = $this->update();
                break;
            default :
                $validate = $this->view();
        }
        return $validate;
    }

    public function messages() {
        return [
            'name.required' => 'Nama kategori tidak boleh kosong!',
            'name.max' => 'Nama kategori maksimal :max karakter',
            'name.min' => 'Nama kategori minimal :min karakter',
            'name.unique' => 'Nama kategori sudah digunakan!'
        ];
    }
}