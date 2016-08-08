<h1 class="page-header">Add News</h1>

<form method="post" action="<?= NEWS_ADMIN_ROOT_URL . '?controller=news&action=add' ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="textarea" name="content" class="form-control" id="content" placeholder="Content">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>

</form>