<?php
namespace frontend\modules\v1\controllers;

use Yii;
use yii\web\Response;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

use common\models\User;
use frontend\models\Note;

/**
 * api v1 - Заметки
 */
class NoteController extends Controller
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

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['list', 'view'],
                    'allow' => true,
                    'roles' => ['@', '?'],
                ],
                [
                    'actions' => ['create', 'update', 'delete'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ]
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'create' => ['post'],
                'update' => ['post'],
            ]
        ];

        return $behaviors;
    }

    /**
     * Список заметок
     * @param  int $p Номер страницы
     */
    public function actionList($p = 1)
    {
        
        $limit = 5;
        $count = Note::find()
                    ->count();

        if ($p > ceil($count / $limit) || $p <= 0)
            throw new NotFoundHttpException;

        $notes = Note::find()
                    ->limit($limit)
                    ->offset(($p - 1) * $limit)
                    ->orderBy(['public_at' => SORT_DESC, 'create_at' => SORT_DESC])
                    ->all();
        return [
            'count'         => $count,
            'pageCount'     => ceil($count / $limit),
            'currentPage'   => $p,
            'notes'         => $notes,
        ];
    }

    /**
     * Просмотр заметки
     * @param  int $id Идентификатор заметки
     */
    public function actionView($id)
    {
        $model = Note::findOne($id);

        if (strtotime($model->public_at) > strtotime(date('Y-m-d H:i:s')) || !$model)
            throw new NotFoundHttpException;

        return $model;
    }

    /**
     * Создание заметки
     */
    
    public function actionCreate()
    {
        // Принимаем на вход заголовок, текст и дату публикации заметки
        // Данные принимаем в пост, т.к. текст заметки может быть большим
        $model              = new Note;
        $model->title       = Yii::$app->request->post('title');
        $model->text        = Yii::$app->request->post('text');
        $model->public_at   = Yii::$app->request->post('public_at');
        $model->user_id     = Yii::$app->user->identity->id;

        if (!$model->save())
            return $model->errors;

        return true;
    }

    /**
     * Создание заметки
     * @param  int $id Идентификатор заметки
     */
    public function actionUpdate($id)
    {
        // Принимаем на вход заголовок, текст и дату публикации заметки
        // Данные принимаем в пост, т.к. текст заметки может быть большим
        $model = Note::findOne($id);

        if (!$model || $model->user_id != Yii::$app->user->identity->id || strtotime($model->public_at) < strtotime('-24 hour'))
            throw new NotFoundHttpException;

        $model->title       = Yii::$app->request->post('title');
        $model->text        = Yii::$app->request->post('text');
        $model->public_at   = Yii::$app->request->post('public_at');

        if (!$model->save())
            return $model->errors;

        return true;
    }

    /**
     * Просмотр заметки
     * @param  int $id Идентификатор заметки
     */
    public function actionDelete($id)
    {
        $model = Note::findOne($id);

        if (!$model || $model->user_id != Yii::$app->user->identity->id || strtotime($model->public_at) < strtotime('-24 hour'))
            throw new NotFoundHttpException;

        $model->delete();

        return true;
    }
}
