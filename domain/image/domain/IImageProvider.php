<?php

namespace app\domain\image\domain;

interface IImageProvider
{
    public function getNextImage(): ImageDTO;

    public function getUrlById(int $imageId): string;
}