<?php require_once APP_ROUTE . '/view/includes/header.php'?>

    <a href="<?php echo URL_ROOT;?>/posts" class="btn btn-light"><i class="fa -fa-backward"></i>Back</a>
    <br>
    <h1>
        <?php echo $data['post']->title?>
    </h1>

    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?php echo $data['post']->name?> on <?php echo $data['post']->created_at?>
    </div>

    <p>
        <?php echo $data['post']->body; ?>
    </p>

    <?php  if ($data['post']->user_id == $data["user"]->id) :?>
        <hr>
        <a class="btn btn-dark" href="<?php echo URL_ROOT;?>/posts/edit/<?php echo $data['post']->id?>">Edit</a>

        <div style="display: inline-block" class="pull-right">
            <form action="<?php echo URL_ROOT;?>/posts/delete/<?php echo $data['post']->id?>" method="post">
                <input type="submit" class="btn btn-danger pull-right" value="Delete">
            </form>
        </div>

    <?php endif; ?>

<?php require_once APP_ROUTE . '/view/includes/footer.php'?>