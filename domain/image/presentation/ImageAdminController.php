<?php

namespace app\domain\image\presentation;

use app\domain\image\application\RemoveImageResultUseCase;
use app\domain\image\domain\IImageProvider;
use app\domain\image\domain\models\Image;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ImageAdminController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly AdminGuard $adminGuard,
        private readonly IImageProvider $imageProvider,
        private readonly RemoveImageResultUseCase $removeImageResultUseCase,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                            return $this->adminGuard->guard();
                        }
                    ],
                ],
                'denyCallback' => function () {
                    Yii::$app->response->redirect(['/']);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Image::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'image_id' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'imageProvider' => $this->imageProvider,
            'token' => $this->adminGuard->getToken(),
        ]);
    }

    public function actionDelete(int $imageId)
    {
        $this->removeImageResultUseCase->handle($imageId);
        $this->redirect(['index', 'token' => $this->adminGuard->getToken()]);
    }
}