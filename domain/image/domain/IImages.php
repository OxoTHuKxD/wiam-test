<?php

namespace app\domain\image\domain;

use app\domain\image\domain\enum\Result;

interface IImages
{
    public function exists(int $imageId): bool;

    public function save(int $imageId, Result $result): void;

    public function remove(int $imageId): void;
}