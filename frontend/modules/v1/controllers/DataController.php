<?php
namespace frontend\modules\v1\controllers;

use Yii;
use yii\web\Response;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

use common\models\User;

/**
 * api v1
 */
class DataController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBearerAuth::className(),
            ],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ]
        ];
        return $behaviors;
    }

    public function actionTest()
    {
        return 1;
    }
}
