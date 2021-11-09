<?php


namespace App\Services;


use App\Models\Access;
use App\Models\Lang;
use App\Models\Paste;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

}
