<?php
$this->load->view("inc/header");
?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title">Edit News</h4>
                </div>
                <div class="card-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Title</label>
                                    <input type="text" class="form-control" name="title" value="<?= $news->title ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-static">Category</label>
                                    <select name="category" class="form-control">
                                        <?php
                                        foreach ($categories as $category) {
                                            echo '<option value="' . $category->id . '" ' . ($news->category_id == $category->id ? 'selected' : '') . '>' . $category->title . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Publish date</label>
                                    <input type="datetime-local" name="publish_date" class="form-control"
                                                 value="<?= date("Y-m-d\TH:i:s", strtotime($news->published_at)) ?>"
                                                 required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <img src="<?= $news->image ?>" width="50%"/>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            Featured:
                                            <input class="form-check-input" type="checkbox" <?= $news->featured==1?'checked':'' ?> name="featured">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="newscontent">Content</label>
                                <textarea name="content" id="newscontent" rows="30"><?= $news->content ?></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">
                            <i class="material-icons">save</i> Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
<?php
$this->load->view("inc/footer");
?>