<?php

namespace redmineModule\controllers;

use redmineModule\helpers\TimeEntriesTempDataHolder;
use redmineModule\models\TimeEntriesSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `redmine-api` module
 */
class TimeEntriesController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $tempDataHolder = new TimeEntriesTempDataHolder();
        $timeEntriesSearch = new TimeEntriesSearch();

        $tempDataHolder->setValues(Yii::$app->request->post(), Yii::$app->request->queryParams);

        $dataProvider = $timeEntriesSearch->search($tempDataHolder->getValues());

        return $this->render('index', [
            "dataProvider" => $dataProvider,
            "searchModel" => $timeEntriesSearch,
        ]);
    }


}
