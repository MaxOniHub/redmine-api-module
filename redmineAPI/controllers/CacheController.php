<?php

namespace redmineModule\controllers;

use Yii;
use yii\caching\CacheInterface;
use yii\web\Controller;

/**
 * Default controller for the `redmine-api` module
 */
class CacheController extends Controller
{

    public function actionFlush()
    {
        if ($key = Yii::$app->request->post("key"))
        {
            /** @var CacheInterface $cache */
            $cache = Yii::$app->controller->module->cache;
            $cache->flush();

            $is_empty_cache = true;
            return $this->renderAjax("/../widgets/views/cache-info-widget/view", ["is_empty_cache" => $is_empty_cache]);
        }
        return $this->redirect(Yii::$app->request->referrer);

    }


}
