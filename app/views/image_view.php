<div class="image">
<h1>
    Картинка
</h1>

<img src ="<?=$data1?>">

<br>

<div class="comments">

<br>

<table class="comments" border="1" align="left">
    <tr>
        <td> Имя </td>
        <td> Комментарий </td>
        <td> Дата создания </td>
    </tr>

<?php
        foreach($data as $item):
    ?>

<tr id="<?=$item['id']?>">
            <td><?=$item['username']?></td>
            <td><?=$item['comment']?></td>
            <td><?=$item['created']?></td>
    </tr>


<?php
            endforeach;
        ?>

</table>

<br>

</div>



<br>
<br>


</div>

     



