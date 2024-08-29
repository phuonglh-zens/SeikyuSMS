<?php

namespace App\Http\Validators;
use Auth;
use Hash; 

class UserInfoValidator extends BaseValidator
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
        'uuid' => 'required|string|max:255',
        'company_code' => 'required|string|max:255',
        'device_token' => 'required|string|max:255',
        'customer_number' => 'required|string|max:255'
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
