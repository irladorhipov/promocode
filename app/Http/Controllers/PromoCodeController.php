<?php

namespace App\Http\Controllers;

use App\Services\PromoCodeService;
use App\Http\Requests\PromoCodeActivationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PromoCodeController extends Controller
{
    /**
     * @param PromoCodeActivationRequest $request
     * @param PromoCodeService $promoCodeService
     * @return JsonResponse
     */
    public function activate(PromoCodeActivationRequest $request, PromoCodeService $promoCodeService): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $result = $promoCodeService->activate($validatedData['user_id'], $validatedData['code']);
            return response()->json($result, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
