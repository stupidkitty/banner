<?php
namespace SK\BannerModule\Api;

use Yii;
use yii\filters\Cors;
use yii\rest\Controller;
use SK\BannerModule\Model\Banner;
use yii\filters\VerbFilter;
use SK\BannerModule\Form\BannerForm;
use yii\web\NotFoundHttpException;
use yii\filters\auth\HttpBearerAuth;

/**
 * MainController
 */
class MainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get', 'head'],
                    'view' => ['get', 'head'],
                    'create' => ['post'],
                    'update' => ['put', 'patch'],
                    'delete' => ['delete'],
                ],
            ],
            'corsFilter' => [
                'class' => Cors::class,
            ],
            /*'authenticator' => [
                'class' => HttpBearerAuth::class,
            ],*/
        ];
    }

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     */
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    /**
     * Lists all Banner models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return Banner::find()->all();
    }

    /**
     * Displays a single Banner model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $banner = $this->findById($id);

        return $banner;
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $banner = new Banner;

        $form = new BannerForm();
        $form->setAttributes($banner->getAttributes());

        if ($form->load(Yii::$app->request->post()) && $form->isValid()) {
            $currentDatetime = gmdate('Y-m-d H:i:s');

            $banner->setAttributes($form->getAttributes());
            $banner->updated_at = $currentDatetime;
            $banner->created_at = $currentDatetime;

            if ($banner->save()) {
                return '';
            }

            return [
                'error' => [
                    'code' => 422,
                    'message' => "Cannot add banner \"{$banner->name}\"",
                    'errors' => $banner->getErrorSummary(true),
                ],
            ];
        }

        return [
            'error' => [
                'code' => 422,
                'message' => "Cannot add banner \"{$form->name}\"",
                'errors' => $form->getErrorSummary(true),
            ],
        ];
    }

    /**
     * Updates an existing Banner model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $banner = $this->findById($id);

        $form = new BannerForm();
        $form->setAttributes($banner->getAttributes());

        if ($form->load(Yii::$app->getRequest()->getBodyParams()) && $form->isValid()) {
            $currentDatetime = gmdate('Y-m-d H:i:s');

            $banner->setAttributes($form->getAttributes());
            $banner->updated_at = $currentDatetime;

            if ($banner->save()) {
                return '';
            }

            return [
                'error' => [
                    'code' => 422,
                    'message' => "Cannot update banner \"{$banner->name}\"",
                    'errors' => $banner->getErrorSummary(true),
                ],
            ];
        }

        return [
            'error' => [
                'code' => 422,
                'message' => "Cannot update banner \"{$form->name}\"",
                'errors' => $form->getErrorSummary(true),
            ],
        ];
    }

    /**
     * Delete banner
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $banner = $this->findById($id);

        if ($banner->delete()) {
            return '';
        }

        Yii::$app->getResponse()->setStatusCode(422);

        return [
            'error' => [
                'code' => 422,
                'message' => 'Can\'t delete banner',
                'errors' => $banner->getErrorSummary(true),
            ],
        ];
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findById($id)
    {
        $banner = Banner::find()
            ->where(['banner_id' => $id])
            ->one();

        if (null === $banner) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $banner;
    }
}
