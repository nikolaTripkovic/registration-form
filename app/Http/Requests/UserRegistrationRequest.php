<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username'  => 'required|string|min:5|max:15|alpha_num|unique:users',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
            'agreement' => 'required|accepted'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'username.required'  => 'The username field is required.',
            'username.unique'    => 'This username is already taken',
            'email.required'     => 'The email field is required.',
            'email.email'        => 'Please provide valid email address',
            'password.required'  => 'The password field is required.',
            'password.confirmed' => 'The passwords do not match.',
            'agreement.required' => 'You must accept agreements',
            'agreement.accepted' => 'You must accept agreements',
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            redirect()->route('register-form')->withErrors($validator)->withInput()
        );
    }

    public function getUsername(): string
    {
        return $this->input('username');
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }

}
