<?php

namespace App\Responses;

use App\ResponseCodes\ResponseCode;

class ManagerResponse
{
    public array $data = [];
    public bool $success = false;
    public int $responseCode;
    public string $message = '';

    public function __construct()
    {
        $this->responseCode = ResponseCode::NONE;
    }

    public function isSucces(): bool
    {
        return $this->success;
    }

    public function isError(): bool
    {
        return $this->success === false;
    }

    public function isSuccessDefault(): bool
    {
        return $this->responseCode == ResponseCode::SUCCESS;
    }

    public function isErrorDefault(): bool
    {
        return $this->responseCode == ResponseCode::ERROR;
    }

    public function is(int $responseCode): bool
    {
        return $this->responseCode == $responseCode;
    }

    public function setSuccess(int $responseCode): void
    {
        $this->success = true;
        $this->responseCode = $responseCode;
    }

    public function setError(int $responseCode): void
    {
        $this->success = false;
        $this->responseCode = $responseCode;
    }
}
