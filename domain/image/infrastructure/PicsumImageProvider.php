<?php

namespace app\domain\image\infrastructure;

use app\domain\image\domain\IImageProvider;
use app\domain\image\domain\IImages;
use app\domain\image\domain\ImageDTO;

class PicsumImageProvider implements IImageProvider
{
    public function __construct(
        private IImages $images,
        private int $minImageId = 1,
        private int $maxImageId = 1000
    )
    {
    }

    public function getNextImage(): ImageDTO
    {
        $nextImageId = random_int($this->minImageId, $this->maxImageId);
        while($this->images->exists($nextImageId)) {
            $nextImageId = random_int($this->minImageId, $this->maxImageId);
        }

        return new ImageDTO(
            $nextImageId,
            $this->getUrlById($nextImageId)
        );
    }

    public function getUrlById(int $imageId): string
    {
        return "https://picsum.photos/id/$imageId/600/500";
    }
}