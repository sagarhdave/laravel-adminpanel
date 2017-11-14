<?php

namespace App\Http\Requests\Backend\Pages;

use App\Http\Requests\Request;

/**
 * Class ManagePagesRequest.
 */
class ManagePagesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-pages');
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
        ];
    }
}
