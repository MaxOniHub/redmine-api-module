<?php

namespace redmineModule\controllers;

use redmineModule\abstractions\AbstractDataCache;
use redmineModule\helpers\TimeEntriesTempDataHolder;
use redmineModule\models\ConditionsForm;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `redmine-api` module
 */
class ProjectsController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        (new TimeEntriesTempDataHolder())->destroy();
        /** @var AbstractDataCache $TimeEntriesCache */
       Yii::$app->controller->module->cache->flush();

        $projectsDataMapper = Yii::createObject(\redmineModule\data_mappers\ProjectsDataMapper::class,
            [Yii::$app->controller->module->redmine]);

        return $this->render('index', [
            "dataProvider" => $projectsDataMapper->getAll(),
            "conditionsForm" => (new ConditionsForm())
        ]);
    }


}
