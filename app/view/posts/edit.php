<?php require_once APP_ROUTE . '/view/includes/header.php'?>

    <!--    --><?php //var_dump($data); exit("asdf"); ?>

    <a href="<?php URL_ROOT ?>/posts" class="btn btn-light">Posts</a>
    <div class="card card-body bd-light mt-5">

        <h2>Edit Post</h2>
        <p>Create a post with this form</p>
        <form action="<?php echo URL_ROOT?>/posts/edit/<?php echo $data["id"];?>" method="post">

            <div class="form-group">
                <label for="title">Title:<sup>*</sup></label>
                <input type="text" name="title" value="<?php echo $data['title'] ?>" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ?  "is-invalid" : "" ?> ">

                <span class="invalid-feedback">
                    <?php echo $data['title_error'] ?>
                </span>
            </div>

            <div class="form-group">
                <label for="body">Body:<sup>*</sup></label>
                <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_error'])) ?  "is-invalid" : "" ?> "><?php echo $data['body']; ?></textarea>
                <span class="invalid-feedback">
                <?php echo $data['body_error'] ?>
                </span>
            </div>

            <input type="submit" value="Submit" class="btn btn-success">

        </form>
    </div>

<?php require_once APP_ROUTE . '/view/includes/footer.php'?>