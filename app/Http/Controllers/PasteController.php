<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paste;
use App\Services\PasteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;

class PasteController extends Controller
{
    /** @var PasteService */
    protected $pasteService;

    /**
     * Constructor
     *
     * @param  PasteService $pasteService
     */
    public function __construct(PasteService $pasteService)
    {
        $this->pasteService = $pasteService;
    }

    /**
     * Create a new paste
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Create the paste
        $paste = $this->pasteService->create($request->input('content'));

        // Return the newly created paste
        return response()->json([
            'slug' => $paste->slug,
            'url' => route('paste.show', $paste),
            'edit_url' => URL::signedRoute('paste.edit', $paste),
            'message' => 'Paste created successfully.'
        ], 201);
    }

    /**
     * Display a paste
     *
     * @param  Request $request
     * @param  Paste $paste
     * @return Response
     */
    public function show(Request $request, Paste $paste)
    {
        return response()->view('pastes.show', [
            'paste' => $paste
        ]);
    }

    /**
     * Edit a paste
     *
     * @param  Request $request
     * @param  Paste $paste
     * @return Response
     */
    public function edit(Request $request, Paste $paste)
    {
        // Verify the URL is signed
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        // Return the edit page
        return response()->view('pastes.edit', [
            'paste' => $paste,
            'updateUrl' => URL::signedRoute('paste.update', $paste)
        ]);
    }

    /**
     * Update a paste
     *
     * @param  Request $request
     * @param  Paste $paste
     * @return JsonResponse
     */
    public function update(Request $request, Paste $paste)
    {
        // Verify the URL is signed
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        // Update the paste
        $this->pasteService->update($paste, $request->input('content'));

        return response()->json([
            'message' => 'Your paste has been successfully updated.',
            'url' => route('paste.show', $paste),
        ]);
    }
}
