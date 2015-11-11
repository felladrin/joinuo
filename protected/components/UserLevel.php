<?php

class UserLevel
{

    public static function isAdmin()
    {
        return Yii::app()->user->getState('level') == 'Administrator';
    }

    public static function isUser()
    {
        return Yii::app()->user->getState('level') == 'User';
    }

}
