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
    <div class="section section-signup page-header" style="padding-top: 20vh;background-image: url('<?=base_url()?>assets/img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="card card-login">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">Login</h4>
                        </div>
                        <div class="card-body">
                            <h3><?= $message ?></h3>
                            <?= form_open('User/login') ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Email Address</label>
                                        <input type="email" class="form-control" name="email" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Password</label>
                                        <input type="password" class="form-control" name="password" required/>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-info" href="<?= base_url('User/register') ?>">Register</a>
                            <button type="submit" class="btn btn-success pull-right">Enter</button>
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