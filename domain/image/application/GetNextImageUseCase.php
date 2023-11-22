<?php

namespace app\domain\image\application;

use app\domain\image\domain\IImageProvider;
use app\domain\image\domain\ImageDTO;

class GetNextImageUseCase
{
    public function __construct(
        private readonly IImageProvider $provider
    )
    {
    }

    public function handle(): ImageDTO
    {
        return $this->provider->getNextImage();
    }
}