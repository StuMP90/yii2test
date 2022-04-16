<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bookshelf */

$this->title = 'Update Bookshelf: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bookshelves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bookshelf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
