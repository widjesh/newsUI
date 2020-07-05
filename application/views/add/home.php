<?php
$this->load->view("inc/header");
?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title">Add home item</h4>
                </div>
                <div class="card-body">
                    <form action="<?= current_url() ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-static">Design</label>
                                    <select name="type" class="form-control">
                                        <option value="" disabled selected>Select</option>
                                        <option value="list">Vertical List</option>
                                        <option value="horizontal">Horizontal List</option>
                                        <option value="carousel">Carousel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Item limit</label>
                                    <input type="number" step="1" min="1" max="200" class="form-control"
                                           name="limit">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-static">Show list</label>
                                    <select name="items" class="form-control">
                                        <option value="" disabled selected>Select</option>
                                        <option value="featured">Featured</option>
                                        <option value="latest">Latest items</option>
                                        <option value="popular">Popular (by views)</option>
                                        <optgroup label="Category">
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
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