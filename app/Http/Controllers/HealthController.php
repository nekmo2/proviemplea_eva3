<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

class HealthController extends Controller
{
    #[OA\Get(
        path: "/health",
        tags: ["Health"],
        responses: [
            new OA\Response(
                response: 200,
                description: "API funcionando"
            )
        ]
    )]
    public function __invoke()
    {
        return response()->json([
            "status" => "ok"
        ]);
    }
}
