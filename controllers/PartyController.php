<?php

namespace app\controllers;

use Yii;

use app\models\Party;
use app\models\PartySearch;
use app\models\PartyHistorySearch;
use app\models\Picture;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use yii\filters\VerbFilter;

/**
 * PartyController implements the CRUD actions for Party model.
 */
class PartyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Party models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Party model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Party model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Party();
        $modelPicture = new Picture();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            $modelPicture->load(Yii::$app->request->post());
            $modelPicture->image = UploadedFile::getInstance($modelPicture, 'image');

            if ($model->validate() & $modelPicture->validate()) {
                if ($modelPicture->save()) {
                    $model->picture_id = $modelPicture->id;
                    $model->save();

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelPicture' => $modelPicture,
        ]);
    }

    /**
     * Updates an existing Party model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPicture = $model->partyPicture ? : new Picture();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            $modelPicture->load(Yii::$app->request->post());
            $modelPicture->image = UploadedFile::getInstance($modelPicture, 'image');

            if ($model->validate() & $modelPicture->validate()) {
                if ($model->save() && $modelPicture->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelPicture' => $modelPicture,
        ]);
    }

    /**
     * Deletes an existing Party model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDisplay($id)
    {
        $model = $this->findModel($id);

        # PartyHistory
        $partyHistorySearch = new PartyHistorySearch();
        $partyHistoryProvider = $partyHistorySearch->search(Yii::$app->request->queryParams);

        // Query
        $partyHistoryProvider->query->where(
            'party_id = :party_id',
            [':party_id' => $id]
        );

        // Pagination
        $partyHistoryProvider->setPagination([
            'pageSize' => 5,
        ]);

        // Sort
//        $partyHistoryProvider->setSort([
//            'defaultOrder' => [
//                'id' => SORT_DESC
//            ]
//        ]);

        return $this->render('display', [
            'model' => $model,
            'partyHistoryProvider' => $partyHistoryProvider,
        ]);
    }

    /**
     * Finds the Party model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Party the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Party::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
