<?php
$this->load->view("inc/header");
?>
    <a href="<?= base_url('Home/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add item</a>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title ">Home Page</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table" data-url="<?=base_url()?>home/sort">
                            <thead class="text-success">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Limit
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr data-id="<?=$item->id?>">
                                    <td class="handle"><?= $item->id ?></td>
                                    <td class="handle"><?= $item->title ?></td>
                                    <td class="handle"><?= $item->type ?></td>
                                    <td class="handle"><?= $item->length ?></td>
                                    <td class="td-actions">
                                        <button type="button" data-url="?del=<?= $item->id ?>" rel="tooltip" title=""
                                                class="del btn btn-danger btn-link btn-sm" data-original-title="Remove">
                                            <i class="material-icons">close</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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