<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var IImageProvider $imageProvider */
/** @var string $token */

use app\domain\image\domain\IImageProvider;
use app\domain\image\domain\models\Image;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <?=yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'image_id',
                    'value' => fn(Image $data) => Html::a(
                        $data->image_id, $imageProvider->getUrlById($data->image_id), [
                            'target' => '_blank',
                        ]
                    ),
                    'format' => 'raw',
                ],
                'result',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'urlCreator' => function( $action, $model, $key, $index ) use ($token) {
                        if ($action == "delete") {
                            return Url::to(['delete', 'imageId' => $model->image_id, 'token' => $token]);
                        }
                    }
                ],
            ],
        ]);?>
    </div>
</div>
