<?php

namespace app\domain\image\domain;

use app\domain\image\domain\enum\Result;

readonly class ImageDTO
{
    public function __construct(
        public int $imageId,
        public string $imageUrl,
        public ?Result $result = null
    )
    {
    }
}