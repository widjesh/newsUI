<?php
$this->load->view("inc/header");
?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title ">Category List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-success">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->created_at ?></td>
                                    <td><?= $user->first_name ?></td>
                                    <td><?= $user->last_name ?></td>
                                    <td><?= $levels[$user->level] ?></td>
                                    <td class="td-actions">
                                        <a rel="tooltip" href="<?= base_url('users/edit/' . $user->id) ?>"
                                           class="btn btn-primary btn-link"
                                           data-original-title="Edit User">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        <button type="button" data-url="?del=<?= $user->id ?>" rel="tooltip" title=""
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