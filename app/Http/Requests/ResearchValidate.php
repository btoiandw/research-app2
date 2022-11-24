<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchValidate extends FormRequest
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
            //
            'year_research' => 'required|max:4',
            'research_nameTH'=>'required|unique:research,research_th',
            'research_nameEN'=>'required|unique:research,research_en'
        ];
    }
    public function messages()
    {
        return [
            'year_research.required' => 'ข้อมูลห้ามเกิน 4 ตัว',
            'research_nameTH.required'=>'โปรดระบุชื่อโครงร่างภาษาไทย',
            'research_nameEN.required'=>'โปรดระบุชื่อโครงร่างภาษาอังกฤษ'
        ];
    }
}
