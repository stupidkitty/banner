<?php
namespace SK\Banner\Controller;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use SK\Banner\Model\Banner;
use SK\Banner\Form\BannerForm;

/**
 * MainController implements the CRUD actions for Banner model.
 */
class MainController extends Controller
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
                    'batch-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banner models.
     *
     * @return mixed
     */
    public function actionIndex($page = 1)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banner::find(),
        ]);

        $dataProvider->prepare(true);

        return $this->render('index', [
            'page' => $page,
            'dataProvider' => $dataProvider,
        ]);
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
// м.б. заранее подготовить в базе строчки, пусть и пустые выключенные, но уже расставленые в шабах
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
                Yii::$app->session->addFlash('success', 'New banner created');

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
                Yii::$app->session->addFlash('success', 'Banner updated');

                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'banner' => $banner,
            'form' => $form,
        ]);
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
