<h1 class="page-header">Add Categories</h1>

<form method="post" action="<?= NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=add' ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>