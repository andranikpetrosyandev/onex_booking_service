<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Room;

class RoomUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'room_type_id'=>'required'
        ];
    }
}
