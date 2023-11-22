<?php

namespace app\domain\image\presentation;

use app\domain\image\application\GetNextImageUseCase;
use app\domain\image\application\SaveImageResultUseCase;
use app\domain\image\domain\enum\Result;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class ImageController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly GetNextImageUseCase $nextImageUseCase,
        private readonly SaveImageResultUseCase $saveImageResultUseCase,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'save-result' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', ['image' => $this->nextImageUseCase->handle()]);
    }

    public function actionSaveResult(int $imageId, string $result)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = new SaveResultRequest($imageId, $result);
        if(!$request->validate()) {
            Yii::$app->response->statusCode = 400;
            return $request->errors;
        }

        $this->saveImageResultUseCase->handle($request->imageId, Result::from($request->result));
        $nextImage = $this->nextImageUseCase->handle();

        return [
            'imageId' => $nextImage->imageId,
            'imageUrl' => $nextImage->imageUrl,
        ];
    }
}