<?php
$this->load->view("inc/header");
?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">User email</label>
                                    <input type="text" name="email" class="form-control" value="<?= $user->email ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">First name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?= $user->first_name ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Last name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?= $user->last_name ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-static">Level</label>
                                    <select name="level" class="form-control">
                                        <?php
                                        foreach ($levels as $key => $value) {
                                            echo '<option value="' . $key . '" ' . ($key == $user->level ? 'selected' : '') . '>' . $value . '</option >';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span>Created at: <strong><?= $user->created_at ?></strong></span>
                            </div>
                        </div>
                        <a class="btn btn-danger" href="<?= current_url() ?>?reset">Reset password</a>

                        <button type="submit" class="btn btn-success pull-right">Save</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
$this->load->view("inc/footer");
?>