<?php

namespace app\domain\image\presentation;

use app\domain\image\domain\enum\Result;
use yii\base\Model;

class SaveResultRequest extends Model
{
    public function __construct(
        public readonly int $imageId,
        public readonly string $result,
        $config = []
    )
    {
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['imageId', 'result'], 'required'],
            ['imageId', 'integer', 'min' => 1],
            ['result', 'in', 'range' => [Result::ACCEPT->value, Result::REJECT->value]],
        ];
    }
}