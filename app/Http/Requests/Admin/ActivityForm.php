<?php
namespace App\Http\Requests\Admin;
class ActivityForm extends CommonForm
{
     public function rules()
    {
        return [
            'title'=>'required',
            'title_url'=>'required',
            'explanation'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ];
    }
}
