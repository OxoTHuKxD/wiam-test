<?php

namespace app\domain\image\application;

use app\domain\image\domain\enum\Result;
use app\domain\image\domain\IImages;

class RemoveImageResultUseCase
{
    public function __construct(
        private readonly IImages $images
    )
    {
    }

    public function handle(int $imageId): void
    {
        $this->images->remove($imageId);
    }
}