<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessResource;
use App\Http\Resources\LangResource;
use App\Http\Resources\PasteResource;
use App\Models\Paste;
use App\Services\PasteService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PasteController extends Controller
{


    public function meta(PasteService $paste)
    {
        return ResponseService::success([
            'langs' => LangResource::collection($paste->langs()),
            'accesses' => AccessResource::collection($paste->accesses())
        ]);
    }

    public function my(PasteService $paste)
    {
        return PasteResource::collection($paste->my());
    }


    public function index(PasteService $paste)
    {

        return PasteResource::collection($paste->public());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param PasteService $paste
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(PasteService $paste, $slug)
    {
        $item = $paste->show($slug);

        if (!$item) {
            ResponseService::notFound();
        }

        Gate::authorize('view', $item);


        return ResponseService::success(
            new PasteResource($item)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
