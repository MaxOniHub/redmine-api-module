<?php

namespace app\modules\redmineAPI;


/**
 * redmine-api module definition class
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = "redmineModule\controllers";

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->layout = 'custom';
        $this->defaultRoute = "/redmine-api";
    }
}
