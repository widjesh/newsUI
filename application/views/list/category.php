<?php
$this->load->view("inc/header");
?>
    <a href="<?= base_url('Category/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add category</a>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title ">Category List</h4>
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
                                    Image
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= $item->id ?></td>
                                    <td><?= $item->title ?></td>
                                    <td><img src="<?= $item->image ?>" alt="image" class="img-thumbnail"></td>
                                    <td class="td-actions">
                                        <a rel="tooltip" href="<?= base_url('Category/edit/' . $item->id) ?>"
                                           class="btn btn-primary btn-link" data-original-title="Edit Category">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
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
echo $this->pagination->create_links();
$this->load->view("inc/footer");
?>