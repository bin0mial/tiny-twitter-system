<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class APIResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $this->formatResponse($next($request));
    }

    private function formatResponse($response)
    {

        $statusCode = $response->getStatusCode();
        $content = $response->getOriginalContent();
        if(is_array($content)){
            if ($statusCode >= 200 and $statusCode < 300) {
                $formattedResponse = [
                    "success" => true,
                    "message" => $content['message'] ?? null,
                    "data" => $content['data'] ?? []
                ];
            } else {
                $formattedResponse = [
                    "success" => false,
                    "message" => $content['message'] ?? null,
                    "errors" => $content['errors'] ?? []
                ];
            }
            $response->setContent(json_encode($formattedResponse));
        }
        return $response;
    }
}
