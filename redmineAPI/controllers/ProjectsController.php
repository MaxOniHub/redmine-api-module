<?php

namespace redmineModule\controllers;

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

        $projectsDataMapper = Yii::createObject(\redmineModule\data_mappers\ProjectsDataMapper::class, [Yii::$app->controller->module->redmine]);

        return $this->render('index', [
            "dataProvider" => $projectsDataMapper->getAll(),
            "conditionsForm" => (new ConditionsForm())
        ]);
    }


}
