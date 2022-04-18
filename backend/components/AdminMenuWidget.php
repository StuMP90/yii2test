<?php
namespace backend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

class AdminMenuWidget extends Widget{
    public $output;

    public function init(){
        parent::init();

        $menuItems = [
            ['label' => 'Home', 'url' => ['/']],
        ];
        
        // Only show menu to authorised users
        if (Yii::$app->user->can('manageShelves')) {
            $menuItems[] = ['label' => 'Bookshelves', 'url' => ['/bookshelf']];
        }
        
        // Only show menu to authorised users
        if (Yii::$app->user->can('manageBooks')) {
            $menuItems[] = ['label' => 'Books', 'url' => ['/book']];
        }
        
        // Only show Gii to logged in users
        if (!(Yii::$app->user->isGuest)) {
            $menuItems[] = ['label' => 'Gii', 'url' => ['/gii']];
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
