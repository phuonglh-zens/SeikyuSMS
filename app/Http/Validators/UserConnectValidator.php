<?php

namespace App\Http\Validators;
use Illuminate\Validation\Rule;
use Auth;
use Hash; 

class UserConnectValidator extends BaseValidator
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
        'uuid' => ['required', Rule::unique('user_infos', 'uuid')->ignore(auth()->user()->id)],
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
