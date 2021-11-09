<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use App\Http\Resources\AccessResource;
use App\Http\Resources\LangResource;
use App\Http\Resources\PasteResource;
use App\Services\PasteService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class PasteController extends Controller
{


    public function meta(PasteService $paste): JsonResponse
    {
        return ResponseService::success([
            'langs' => LangResource::collection($paste->langs()),
            'accesses' => AccessResource::collection($paste->accesses())
        ]);
    }

    public function my(PasteService $paste): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
     * @param PasteService $paste
     * @param PasteRequest $request
     * @return PasteResource
     */
    public function store(PasteService $paste, PasteRequest $request): PasteResource
    {
        $data = $paste->addPaste($request->getDto());
        return new PasteResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param PasteService $paste
     * @param $slug
     * @return JsonResponse|PasteResource
     */
    public function show(PasteService $paste, $slug)
    {
        $item = $paste->show($slug);

        if (!$item || !Gate::inspect('view', $item)->allowed()) {
            return ResponseService::notFound();
        }

        return new PasteResource($item);
    }

}
