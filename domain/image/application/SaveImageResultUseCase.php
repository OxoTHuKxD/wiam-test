<?php

namespace app\domain\image\application;

use app\domain\image\domain\enum\Result;
use app\domain\image\domain\IImages;

class SaveImageResultUseCase
{
    public function __construct(
        private readonly IImages $images
    )
    {
    }

    public function handle(int $imageId, Result $result): void
    {
        $this->images->save($imageId, $result);
    }
}