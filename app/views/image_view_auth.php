<div class="image">
<h1>
    Картинка
</h1>

<img src ="<?=$data1?>" class="img-responsive">

<br>

<div class="comments">

<br>

<table class="comments" border="1" align="left">
    <tr>
        <td> Имя </td>
        <td> Комментарий </td>
        <td> Дата создания </td>
        <td> Удалить комментарий</td>
    </tr>

<?php
        foreach($data as $item):
    ?>

<tr id="<?=$item['id']?>">
            <td><?=$item['username']?></td>
            <td><?=$item['comment']?></td>
            <td><?=$item['created']?></td>
            <td class="comment-action"><a href="<?=$item['id']?>">Удалить</a></td>
    </tr>

<?php
            endforeach;
        ?>

</table>

<br>
</div>

<br>

<h2>
    Оставить комментарий к картинке
</h2>

<div class="container">
            <div class="row justify-content-left">
                <div class="col-4">
                    <form id="comments">
                        <div class="form-group">
                            <label for="imgLink">Название картинки</label>
                            <input type="imgLink" class="form-control" id="imgLink" name="imgLink" value="<?=$data1?>" READONLY>
                            <div class="form-control-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <input type="comment" class="form-control" id="comment" name="comment" placeholder="Оставьте комментарий">
                            <div class="form-control-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить комментарий</button>
                    </form>
                </div>
            </div>
</div>

</div>

     

<script src="/JS/form_upload_comments.js"></script>
<script src="/JS/form_comment.js"></script>

