<?php
$this->load->view("inc/header");
$userData = $this->session->userdata();
?>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">dvr</i>
                    </div>
                    <p class="card-category">News</p>
                    <h3 class="card-title">
                        <?= $news ?>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">add</i>
                        <a href="<?= base_url('News/add') ?>">Add news</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">dns</i>
                    </div>
                    <p class="card-category">Category</p>
                    <h3 class="card-title"><?=$category?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <?php if ($userData['level'] > 1):?>
                            <i class="material-icons">add</i>
                            <a href="<?= base_url('Category/add') ?>">Add category</a>
                        <?php else: ?>
                            <i class="material-icons">date_range</i> All time
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">person_outline</i>
                    </div>
                    <p class="card-category">Users</p>
                    <h3 class="card-title"><?=$users?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> All time
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <p class="card-category">Views</p>
                    <h3 class="card-title"><?=$views?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title ">News List</h4>
                    <p class="card-category">Latest news added</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-success">
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Published
                                    </th>
                                    <th>
                                        Views
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($items as $item):?>
                                <tr>
                                    <td>
                                        <?=$item->id?>
                                    </td>
                                    <td>
                                        <?=$item->title?>
                                    </td>
                                    <td>
                                        <?=$item->published_at?>
                                    </td>
                                    <td class="text-success">
                                        <?=$item->views?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->load->view("inc/footer");
?>