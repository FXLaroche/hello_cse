<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request as FormRequest;

class ProfileRequest extends FormRequest
{
    /* Orion validation: https://orion.tailflow.org/guide/security#validation */

    public function commonRules() : array
    {
        return [
            'firstname' => 'string',
            'lastname' => 'string',
            'status' => 'string|in:inactive,awaiting,active',
            'profilePicture' => 'file|image|between:0,1024',
        ];
    }

    public function storeRules() : array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'status' => 'required',
            'profilePicture' => 'required',
        ];
    }
}
