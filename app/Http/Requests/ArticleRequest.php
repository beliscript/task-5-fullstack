<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

    private function default() {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'max:35', 'min:3'],
            'content' => ['required', 'max:500'],
            'image' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048']
        ];
    }

    private function store() {
        $required = $this->default();
        //Add unique name article
        array_push($required['title'],'unique:articles,title');
        array_push($required['image'],'required');
        return  $required;
    }
    private function update() {
        $required = $this->default();
        //Add unique name article
        array_push($required['title'],'unique:articles,title,'.$this->article->id.'');
        return  $required;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
            'title.required' => 'Judul tidak boleh kosong!',
            'content.required' => 'Konten tidak boleh kosong!',
            'image.required' => 'Gambar tidak boleh kosong!',
            'category_id.required' => 'Kategori tidak boleh kosong!',
        ];
    }
}