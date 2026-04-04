<?php
use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="project-form">

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tech_stack')->widget(Summernote::class, [
    'useKrajeePresets' => true,
]) ?>

<?= $form->field($model, 'status')->dropDownList([
    'pending' => 'Pending',
    'completed' => 'Completed',
], ['prompt' => 'Select status']) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::class, [
    'dateFormat' => 'yyyy-MM-dd',
]) ?>

<?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::class, [
    'dateFormat' => 'yyyy-MM-dd',
]) ?>

<?= $form->field($model, 'imageFiles')->widget(FileInput::class, [
    'options' => [
        'accept' => 'image/*',
        'multiple' => true,
    ],
    'pluginOptions' => [
        'showUpload' => false,
        'allowedFileExtensions' => ['jpg', 'jpeg', 'png'],
        'previewFileType' => 'image',
    ],
]) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
