<?php

namespace App\Http\Requests;

use App\Dto\PasteDto;

class PasteRequest extends ApiRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'content'=>'required',
        ];
    }

    public function getDto(): PasteDto
    {
        return new PasteDto(
            $this->get('title'),
            $this->get('content'),
            $this->get('user_id'),
            $this->get('access_id'),
            $this->get('lang_id'),
            $this->get('expiration_time'),
        );
    }
}
