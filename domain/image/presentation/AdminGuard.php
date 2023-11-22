<?php

namespace app\domain\image\presentation;

use Yii;

class AdminGuard
{
    public function __construct(
        private readonly string $token
    )
    {
    }

    public function guard(): bool
    {
        return Yii::$app->request->get('token') === $this->token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}