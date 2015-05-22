<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChooseDoorRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $closed_doors = collect(range(1, 3))->filter(function($door) {
            return $door !== $this->game->revealed_door;
        });
        return [
            'door' => 'required|in:' . $closed_doors->implode(','),
        ];
    }
}
