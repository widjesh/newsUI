<?php
$this->load->view("inc/header");
?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">User email</label>
                                    <input type="text" class="form-control" name="email" value="<?= $user->email ?>" disabled/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">First name</label>
                                    <input type="text" class="form-control" name="first_name" value="<?= $user->first_name ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Last name</label>
                                    <input type="text" class="form-control" name="last_name" value="<?= $user->last_name ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Change password</label>
                                    <input type="text" class="form-control" name="password"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Repeat password</label>
                                    <input type="text" class="form-control" name="trypassword"/>
                                </div>
                            </div>
                        </div>
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