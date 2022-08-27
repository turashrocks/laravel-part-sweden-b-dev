<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 * )
 */
class DepartmentCreateRequest extends FormRequest
{
    /**
     * @OA\Property(
     *   title="name"
     * )
     *
     * @var string
     */
    public $name;

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
            'name' => 'required'
        ];
    }
}
