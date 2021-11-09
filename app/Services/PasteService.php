<?php


namespace App\Services;


use App\Models\Access;
use App\Models\Lang;
use App\Models\Paste;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

class PasteService
{
    public function langs()
    {
        return Lang::all();
    }

    public function accesses()
    {
        return Access::all();
    }

    public function public($pages = 10)
    {
        return Access::where('title', 'public')->first()
            ->pastes()
            ->expired()
            ->new()
            ->paginate($pages);
    }

    public function my($pages = 10)
    {
        return Auth::user()
            ->pastes()
            ->expired()
            ->new()
            ->paginate($pages);
    }

    public function show($slug)
    {
        return Paste::where('slug', $slug)
            ->expired()
            ->first();
    }

    public function addPaste($dto)
    {
        $faker = Faker::create();

        $slug = $faker->bothify('?#?#?#?#');
        while (Paste::whereSlug($slug)->exists()) {
            $slug = $faker->bothify('?#?#?#?#');;
        }

        if($dto->expiration_time){
            $dto->expiration_time = Carbon::createFromTimestamp($dto->expiration_time);
        }

        return Paste::create([
            'title' => $dto->title,
            'content' => $dto->content,
            'slug' => $slug,
            'user_id' => $dto->user_id,
            'access_id' => $dto->access_id,
            'lang_id' => $dto->lang_id,
            'expiration_time' => $dto->expiration_time,
        ]);
    }

}
