<?php
namespace backend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use backend\models\Menu;

class AdminMenuWidget extends Widget{
    public $output;

    public function init(){
        parent::init();

        // Get menu items from model
        $menulist = Menu::find()->orderBy('order')->all();
        
        // Loop through menu items
        foreach ($menulist as $item) {
            // Check if a permission check is required
            if ((isset($item->permission)) && ($item->permission !== "")) {
                if ($item->permission == "LOGGEDIN") {  // Special case, require user to be logged in
                    if (!(Yii::$app->user->isGuest)) {
                        $menuItems[] = ['label' => Html::encode($item->label), 'url' => [Html::encode($item->url)]];
                    }
                } elseif ($item->permission == "GUEST") {  // Special case, require user to be guest
                    if (Yii::$app->user->isGuest) {
                        $menuItems[] = ['label' => Html::encode($item->label), 'url' => [Html::encode($item->url)]];
                    }
                } else {
                    // Check for permission
                    if (Yii::$app->user->can($item->permission)) {
                        $menuItems[] = ['label' => Html::encode($item->label), 'url' => [Html::encode($item->url)]];
                    }
                }
            } else {    // No check needed so add menu item
                $menuItems[] = ['label' => Html::encode($item->label), 'url' => [Html::encode($item->url)]];
            }
        }
        
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        
        $this->output = Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
    }

    public function run(){
        return $this->output;
    }
}
