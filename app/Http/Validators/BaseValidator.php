<?php

namespace App\Http\Validators;

use Validator;
use Illuminate\Validation\Factory as ValidatorFactory;

/**
 * Class BaseFormRepository
 * @package App\Repositories\Validate
 * @property \Illuminate\Validation\Factory validator
 * @property Validator validation
 *
 *
 * @author datpt@nal.vn
 */
abstract class BaseValidator
{

    /**
     * @var \Illuminate\Validation\Factory
     */
    private $validator;

    protected $validation;

    /**
     * @param \Illuminate\Validation\Factory $validator
     */
    public function __construct(ValidatorFactory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $formData
     * @return bool
     * @throws FormValidationException
     */
    public function validate(array $formData)
    {
        $this->validation = $this->validator->make(
            $formData,
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );

        if ($this->validation->fails()) {
            return $this->validation->errors();
        }

        return true;
    }

    /**
     * @return array
     */
    abstract public function rules();

    /**
     * @return array
     */

    abstract public function messages();

    /**
     * @return array
     */
    abstract public function attributes();
}
