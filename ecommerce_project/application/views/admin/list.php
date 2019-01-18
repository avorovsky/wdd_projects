<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?=ucfirst(str_replace('_', ' ', $params[0]))?>&nbsp;<a href="/admin/new/<?=$params[0]?>" title="New"><i class="far fa-plus-square"></i></a></h1>
    </div>
    <table id="data" class="table table-hover table-striped table-bordered table-responsive">
        <thead>
            <tr class="bg-primary">
<?php

    foreach ($params['fields'] as $key => $value) {

?>
                <th class="align-top"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?></th>
<?php } // foreach ?>
                <th class="align-top">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php

    foreach ($data as $key => $value) {

?>
            <tr>
<?php

        foreach ($params['fields'] as $fieldKey => $fieldValue) {

?>
                <td class="align-top"><?=$value[$fieldValue['COLUMN_NAME']]?></td>
<?php   } // foreach ?>
                <td class="align-top">
                    <a href="/admin/edit/<?=$params[0]?>/<?=$value['id']?>" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/delete/<?=$params[0]?>/<?=$value['id']?>" title="Delete" onclick="return confirm('Are you sure? Please confirm the deletion');"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
<?php } // foreach ?>
        </tbody>
    </table>
</main>
