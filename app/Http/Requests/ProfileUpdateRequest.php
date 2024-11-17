<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->has('name')) {
            return [
                'name' => ['required', 'string', 'max:255']
            ];
        } else if($this->has('email')) {
            return [
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            ];
        } else if($this->has('address')) {
            return [
                'address' => ['required', 'string'],
            ];
        } else {
            return [
                'phone' => ['required', 'string', 'max:255']
            ];
        }
    }
}
