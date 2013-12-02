
<tr>
    <?php
        echo $form->hiddenField($model, "[$id]id");
    ?>
    <td>
        <?php echo $form->textField($model, "[$id]name"); ?>
    </td>
    <td>
        <?php echo CHtml::link('Удалить', '#', array('onClick' => 'deleteColor($(this));return false;')); ?>
    </td>
</tr>
