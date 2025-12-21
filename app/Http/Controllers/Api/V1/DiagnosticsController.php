<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosticsController extends Controller
{
    /**
     * Endpoint para diagnóstico de rotas
     * GET /api/v1/diagnostics
     */
    public function index(Request $request)
    {
        return response()->json([
            'current_route' => $request->route()?->getName() ?? 'none',
            'current_path' => $request->path(),
            'request_method' => $request->method(),
            'request_headers' => [
                'content-type' => $request->header('content-type'),
                'accept' => $request->header('accept'),
            ],
            'app_env' => env('APP_ENV'),
            'debug' => env('APP_DEBUG'),
            'routes_cached' => file_exists(base_path('bootstrap/cache/routes-v7.php')),
            'config_cached' => file_exists(base_path('bootstrap/cache/config.php')),
            'message' => 'Se você vir isso, o servidor está respondendo corretamente para GET'
        ]);
    }

    /**
     * Endpoint para testar POST
     * POST /api/v1/diagnostics/test-post
     */
    public function testPost(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'POST funcionando corretamente!',
            'received_data' => $request->all(),
            'request_method' => $request->method(),
        ]);
    }
}
