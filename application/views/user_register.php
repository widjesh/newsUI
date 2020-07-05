<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="<?= base_url() ?>assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
</head>
<body>
<div class="wrapper">
    <div class="section section-signup page-header"
         style="padding-top: 20vh;background-image: url('<?= base_url() ?>assets/img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 ml-auto mr-auto">
                    <div class="card card-login">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">Login</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= validation_errors() ?>
                                </div>
                            </div>
                            <?= form_open('User/register') ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">First name</label>
                                        <input type="text" class="form-control" name="first_name"
                                               value="<?= set_value('first_name') ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Last name</label>
                                        <input type="text" class="form-control" name="last_name"
                                               value="<?= set_value('last_name') ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Email Address</label>
                                        <input type="email" class="form-control" name="email"
                                               value="<?= set_value('email') ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Password</label>
                                        <input type="text" class="form-control" name="password"
                                               value="<?= set_value('password') ?>" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Password Confirm</label>
                                        <input type="text" class="form-control" name="passconf"
                                               value="<?= set_value('passconf') ?>" required/>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-info" href="<?= base_url('User/login') ?>">Login</a>
                            <button type="submit" class="btn btn-success pull-right">Register</button>
                            <div class="clearfix"></div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap-material-design.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="<?= base_url() ?>assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
</body>
</html>