<?php
namespace SK\Banner\Controller;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use SK\Banner\Model\Banner;
use SK\Banner\Form\BannerForm;

/**
 * AjaxController implements the CRUD actions for Banner model.
 */
class AjaxController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
           'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                       'allow' => true,
                       'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     */
    public function beforeAction($action)
    {
        Yii::$app->controller->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * Lists all Banner models.
     *
     * @return mixed
     */
    public function actionGetBanners()
    {
        $banners = Banner::find()->all();

        $responseItems=[];

        foreach ($banners as $banner) {
            $responseItems[] = [
                'id' => $banner->getId(),
                'name' => $banner->name,
                'comment' => $banner->comment,
                'code' => $banner->code,
                'start_at' => $banner->start_at,
                'end_at' => $banner->end_at,
                'desktop' => (bool) $banner->desktop,
                'mobile' => (bool) $banner->mobile,
                'enabled' => (bool) $banner->enabled,
                'updated_at' => $banner->updated_at,
                'created_at' => $banner->created_at,
                'view_link' => Url::toRoute(['main/view', 'id' => $banner->getId()]),
                'update_link' => Url::toRoute(['update', 'id' => $banner->getId()]),
                'delete_link' => Url::toRoute(['main/delete', 'id' => $banner->getId()]),
            ];
        }

        return $this->asJson($responseItems);
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

        return $this->render('view', [
            'banner' => $banner,
        ]);
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
                Yii::$app->session->addFlash('error', 'New banner created');

                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'banner' => $banner,
            'form' => $form,
        ]);
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

        if ($form->load(Yii::$app->request->post()) && $form->isValid()) {
            $currentDatetime = gmdate('Y-m-d H:i:s');

            $banner->setAttributes($form->getAttributes());
            $banner->updated_at = $currentDatetime;

            if ($banner->save()) {
                return $this->asJson([
                    'message' => "Banner \"{$banner->name}\" updated",
                ]);
            }

        }

        if ($form->hasErrors()) {
            return $this->asJson([
                'error' => [
                    'message' => implode('<br>', $form->getErrorSummary(true)),
                ]
            ]);
        }

        return $this->asJson('');
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $banner = $this->findById($id);

        if ($banner->delete()) {
            Yii::$app->session->addFlash('success', Yii::t('banner', 'banner_deleted', ['name' => $baner->name]));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     *
     * @return Banner the loaded model
     *
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
