<?php

namespace App\Http\Validators;
use Auth;
use Hash; 

class Media4uValidator extends BaseValidator
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
        'mobilenumber' => 'required|string',
        'smstitle' => 'required|string',
        'smstext' => 'required|string',
        'smstext2' => 'required|string',
        'originalurl' => 'required|string',
        'status' => 'required|numeric',
        'smsid' => 'required|integer',
        'carrier' => 'required|string',
        'smstextdocomo' => 'required|string',
        'smstextsoftbank' => 'required|string',
        'docomotitle' => 'required|string',
        'autitle' => 'required|string',
        'softbanktitle' => 'required|string',
        'smsparts' => 'required|integer',
      ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
      return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
      return [];
    }
}
