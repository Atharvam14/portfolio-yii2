<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // clear old data
        $auth->removeAll();

        // create permission
        $manageProjects = $auth->createPermission('manageProjects');
        $manageProjects->description = 'Manage Projects';
        $auth->add($manageProjects);

        // create role
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        // assign permission to role
        $auth->addChild($admin, $manageProjects);

        // assign role to user (id = 1)
        $auth->assign($admin, 1);

        echo "RBAC initialized successfully\n";
    }
}