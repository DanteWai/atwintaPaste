<?php


namespace App\Dto;


use phpDocumentor\Reflection\Types\Integer;

class PasteDto implements Dto
{
    public $title;
    public $content;
    public $access_id;
    public $lang_id;
    public $user_id;
    public $expiration_time;

    public function __construct(
        $title,
        $content,
        $user_id,
        $access_id,
        $lang_id,
        $expiration_time
    )
    {
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->access_id = $access_id;
        $this->lang_id = $lang_id;
        $this->expiration_time = $expiration_time;
    }
}
