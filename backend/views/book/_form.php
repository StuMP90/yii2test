<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Bookshelf;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'isbn')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location_id')->dropDownList(
            ArrayHelper::map(Bookshelf::find()->orderBy('location')->all(),'id','location'),
            ['prompt'=>'Select Bookshelf']
       )?> 

    <div class="form-group">
        <?= Html::button('ISBN Lookup', [ 'class' => 'btn btn-primary', 'onclick' => '(function ( $event ) { checkISBN(); })();' ]) ?>
        &nbsp;
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script type="text/javascript">
        function checkISBN() {
            var isbn_field = document.getElementById('book-isbn');
            // Openlibrary call formats
            //'https://openlibrary.org/api/books?bibkeys=ISBN:0553408828&jscmd=data&format=json'
            //'https://openlibrary.org/api/books?bibkeys=ISBN:0553408828&jscmd=data'
            //'https://openlibrary.org/api/books?bibkeys=ISBN:0553408828&callback=processBooks'
            $.getJSON('https://openlibrary.org/api/books?bibkeys=ISBN:'+isbn_field.value+'&jscmd=data&format=json', function(data) {
                // JSON result in `data` variable
                // Get top level key (string including ISBN)
                let key = "";
                for (const x in data) {
                    key = x;
                    break;
                }
                if (key !== "") {
                    let errors = "";

                    // Set title in form if we have data
                    if ('title' in data[key]) {
                        var title = data[key]['title'];
                        if (title !== "") {
                            document.getElementById('book-title').value = title;
                        }
                    } else {
                       errors += "Title not found. " 
                    }

                    // Set author in form if we have data
                    if ('authors' in data[key]) {
                        var author = data[key]['authors'][0]['name'];
                        if (author !== "") {
                            document.getElementById('book-author').value = author;
                        }
                    } else {
                       errors += "Author not found. " 
                    }

                    if (errors !== "") {
                        alert(errors);
                    }
                } else {
                    alert('ISBN required. ');
                }
            });
        }
    </script>
</div>
