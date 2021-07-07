<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator) : void
    {
        $preparedErrors = [];
        foreach ($validator->errors()->getMessages() as $errors) {
            if (isset($errors[0]) && \is_string($errors[0])) {
                $preparedErrors[] = $errors[0];
            }
        }

        if ($this->ajax() || $this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'errors'  => $preparedErrors,
                ])
            );
        }
        foreach ($preparedErrors as $preparedError) {
            flash()->error($preparedError);
        }

        throw new HttpResponseException(
            redirect()->back()->withInput()
        );
    }
}
