<?php

namespace yii\helpers;

//use yii\helpers\Html;
use Yii;

/**
 * Class Common
 * @package yii\helpers
 * @method public getControllerId()
 */
class Common
{
    /** CODE HERE **/

    /**
     * @return \yii\console\Controller|\yii\web\Controller
     */
    public static function getController()
    {
        return Yii::$app->controller;
    }

    /**
     * @return \yii\console\Controller|\yii\web\Controller->id
     */
    public static function getControllerId()
    {
        return Yii::$app->controller->id;
    }

    /**
     * @return \yii\base\Module
     */
    public static function getModule()
    {
        return Yii::$app->controller->module;
    }

    /**
     * @return \yii\base\Module->id
     */
    public static function getModuleId()
    {
        return Yii::$app->controller->module->id;
    }

    /**
     * @return \yii\base\Action
     */
    public static function getAction()
    {
        return Yii::$app->controller->action;
    }

    /**
     * @return \yii\base\Action->id
     */
    public static function getActionId()
    {
        return Yii::$app->controller->action->id;
    }
}