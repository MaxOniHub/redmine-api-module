<?php

namespace redmineModule\helpers;

use Yii;

/**
 * Class SessionHolder
 * @package redmineModule\helpers
 */
class TempDataHolder
{
    /**
     * @var mixed|\yii\web\Session
     */
    private $session;

    public function __construct()
    {
        $this->session = Yii::$app->session;
    }

    public function setValues($key, $values)
    {
        $this->session->set($key, $values);
    }

    public function getValues($key)
    {
        return $this->session->get($key);
    }

    public function destroy()
    {
        $this->session->destroy();
    }
}