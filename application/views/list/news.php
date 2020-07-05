<?php
$this->load->view("inc/header");
$userData = $this->session->userdata();
?>


    <div class="row">
        <div class="col-md-3">
            <a href="<?=base_url('News/add')?>" class="btn btn-success"><i class="fa fa-plus"></i> Add News</a>
        </div>

        <div class="filter col-md-3">
            <div class="input-group no-border">
                <select class="select form-control" name="category">
                    <option value="" disabled selected>Select</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?=base_url('News/index/'.$category->id)?>" <?=$category->id==$selected_id?'selected':''?>><?=$category->title?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <form class="navbar-form col-md-3">
            <div class="input-group no-border">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                </button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title ">News List</h4>
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
                                        Category
                                    </th>
                                    <th>
                                        Publish date
                                    </th>
                                    <th>
                                        Active
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($items as $item):?>
                                <tr>
                                    <td><?=$item->id?></td>
                                    <td><?=$item->title?></td>
                                    <td><?=get_category_name($item->category_id)?></td>
                                    <td><?=$item->published_at?></td>
                                    <td>
                                        <div class="togglebutton">
                                            <label class="switch">
                                                <input type="checkbox" id="<?=$item->id?>" <?=$item->is_active==1?"checked":""?>>
                                                <span class="toggle"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="td-actions text-right">
                                        <?php if ($item->author_id==$userData['user_id'] || $userData['level'] > 1): ?>
                                            <button rel="tooltip" title="" class="btn btn-primary btn-link featured" data-id="<?=$item->id?>" data-original-title="Make featured News">
                                                <i class="material-icons"><?= $item->featured==1 ? 'star' : 'star_outline'?></i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            <a href="<?=base_url('News/edit/'.$item->id)?>" rel="tooltip" title="" class="btn btn-primary btn-link" data-original-title="Edit News">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <button type="button" data-url="?del=<?=$item->id?>" rel="tooltip" title="" class="del btn btn-danger btn-link btn-sm" data-original-title="Remove">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                        <?php endif; ?>
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
    echo $this->pagination->create_links();
    $this->load->view("inc/footer");
?>