<?php

/** @var yii\web\View $this */
/** @var \app\domain\image\domain\ImageDTO $image */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="mt-3 row">
            <div class="text-center col col-12">
                <img id="main-image" src="<?=$image->imageUrl?>">
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col col-6 text-end">
                <button id="accept-button" data-image-id="<?=$image->imageId?>" onclick="processAcceptButton();" class="button">Одобрить</button>
            </div>
            <div class="col col-6">
                <button id="reject-button" data-image-id="<?=$image->imageId?>" onclick="processRejectButton();" class="button">Отклонить</button>
            </div>
        </div>
    </div>
</div>
