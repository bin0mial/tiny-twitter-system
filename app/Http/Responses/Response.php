<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class Response implements Responsable
{
    private $data;
    private $message;
    private $status;

    public function __construct($data, $status=200, $message="Success")
    {
        $this->data = $data;
        $this->message = $message;
        $this->status = $status;
    }

    public function toResponse($request)
    {
        $data = [
            "message" => $this->message,
            "data" => $this->data,
        ];
        return response()->json($data)->setStatusCode($this->status);
    }
}
