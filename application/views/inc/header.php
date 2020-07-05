<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$userData = $this->session->userdata();
if (!$userData['logged_in']) {
    redirect('User');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href="<?= base_url() ?>assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    </head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="<?=base_url()?>assets/img/sidebar-1.jpg">
        <div class="logo">
            <a href="<?=base_url()?>" class="simple-text logo-normal">
                Admin Panel
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Dashboard') ?>">
                        <i class="material-icons">home</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Home') ?>">
                        <i class="material-icons">dashboard</i>
                        <p>Home Screen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('News')?>">
                        <i class="material-icons">dvr</i>
                        <p>News list</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('News/add')?>">
                        <i class="material-icons">add_circle</i>
                        <p>Add news</p>
                    </a>
                </li>

                <?php if ($userData['level'] > 1):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('Category')?>">
                            <i class="material-icons">dns</i>
                            <p>Category list</p>
                        </a>
                    </li>
                <?php endif;?>
                <?php if ($userData['level'] > 1):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('Category/add')?>">
                            <i class="material-icons">add_circle</i>
                            <p>Add Category</p>
                        </a>
                    </li>
                <?php endif;?>
                <?php if ($userData['level'] > 2):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('Users')?>">
                            <i class="material-icons">person</i>
                            <p>User list</p>
                        </a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo"><?= isset($title) ? $title : "Dashboard" ?></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form" action="<?=base_url('news')?>">
                      <div class="input-group no-border">
                        <input type="text" value="" class="form-control" name="search" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                          <i class="material-icons">search</i>
                          <div class="ripple-container"></div>
                        </button>
                      </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">person</i>
                              <p class="d-lg-none d-md-block">
                                Account
                              </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                              <a class="dropdown-item" href="<?=base_url('User/edit')?>">Profile</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="<?=base_url('User/logout')?>">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <?php if (isset($message)):?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span><?=$message?></span>
                            </div>
                        </div>
                    </div>
                <?php endif;?>