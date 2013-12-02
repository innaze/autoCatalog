<?php

Yii::app()->clientScript->registerScript('rowColor', "var lastColor = 0;
    var trColor = new String(" .
        CJSON::encode($this->renderPartial('rowColor', array('id' => 'idRep', 'model' => new Colors, 'form' => $form, 'this' => $this), true, false)) .
        ");
    function addColor(button)
    {
        lastColor++;
        button.parents('table').children('tbody').append(trColor.replace(/idRep/g, 'newRow' + lastColor));
    }


    function deleteColor(button)
    {
        button.parents('tr').detach();
    }
");
?>
