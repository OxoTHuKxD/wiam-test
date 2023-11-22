<?php

namespace app\domain\image\infrastructure;

use app\domain\image\domain\enum\Result;
use app\domain\image\domain\IImages;
use app\domain\image\domain\models\Image;

class ImagesRepository implements IImages
{
    public function exists(int $imageId): bool
    {
        return Image::find()->where(['image_id' => $imageId])->exists();
    }

    public function save(int $imageId, Result $result): void
    {
        $image = new Image();
        $image->image_id = $imageId;
        $image->result = $result->value;
        $image->save();
    }

    public function remove(int $imageId): void
    {
        $image = Image::find()->where(['image_id' => $imageId])->one();
        $image->delete();
    }
}