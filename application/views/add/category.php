<?php
$this->load->view("inc/header");
?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body">
                <form action="<?=current_url()?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label>Image</label>
                                <input type="file" name="image" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Add</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view("inc/footer");
?>