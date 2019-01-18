<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?=ucfirst(str_replace('_', ' ', $params[0]))?> <?=(empty($params[1]) ? '[New]' : 'ID#'.$params[1])?></h1>
    </div>
    <form action="/admin/save" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
<?php

    foreach ($params['fields'] as $key => $value) {

        // ckeck for restrictions
        $schema = new \Models\Schema();
        $restrictions = $schema->getRestrictions($value['TABLE_NAME'], $value['COLUMN_NAME']);

        if ($restrictions) {

            // shift array's level
            $restrictions = $restrictions[0];
            // get data for select
            $select = $schema->getData($restrictions["REFERENCED_TABLE_NAME"]);

            // field from tables for main view
            $mainView = array(
                'categories' => 'name',
                'countries' => 'country_name',
                'products' => 'name',
                'users' => 'username',
                'invoices' => 'id',
                'shipping_methods' => 'name',
                );
?>
        <div class="form-group">
            <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
            <select class="form-control"
                    <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?> 
                    name="<?=$value['COLUMN_NAME']?>">
                <option value="" disabled selected>Select <?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?></option>
<?php
            // output options to select
            foreach ($select as $keySelect => $valueSelect) {

?>
                <option value="<?=$valueSelect[$restrictions["REFERENCED_COLUMN_NAME"]]?>"
                    <?=($valueSelect[$restrictions["REFERENCED_COLUMN_NAME"]]==$data[0][$value['COLUMN_NAME']] ? ' selected' : '')?>>
                    <?='['.$valueSelect[$restrictions["REFERENCED_COLUMN_NAME"]].'] '.$valueSelect[$mainView[$restrictions["REFERENCED_TABLE_NAME"]]]?>
                </option>
<?php       } // foreach ?>
            </select>

<?php   } elseif ($value['COLUMN_NAME']=='image') { ?>

            <div class="form-group">
                <label for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                <div class="custom-file">
                    <input class="custom-file-input" 
                            id = "inputFile" 
                            type="file"
                            name="<?=$value['COLUMN_NAME']?>" 
                            placeholder="<?=$value['COLUMN_NAME']?>"
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            value="<?=$data[0][$value['COLUMN_NAME']]?>">
                    <label class="custom-file-label<?=(empty($data[0][$value['COLUMN_NAME']]) ? '' : ' selected')?>" for="<?=$value['COLUMN_NAME']?>"><?=(empty($data[0][$value['COLUMN_NAME']]) ? 'Choose image file...' : $data[0][$value['COLUMN_NAME']])?></label>
                </div>
                <div class="text-center">
                    <img id="image_upload_preview" class="rounded" src="<?=(empty($data[0][$value['COLUMN_NAME']]) ? '' : IMG.($params[0]=='images' ? 'products' : $params[0]).DS.$data[0][$value['COLUMN_NAME']])?>">
                </div>

                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#image_upload_preview').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#inputFile").change(function () {
                        readURL(this);
                    });

                    $(document).ready(function () {
                        $('.custom-file-input').on('change', function(){
                          var fileName = $(this).val();
                          $(this).next('.custom-file-label').addClass("selected").html(fileName);
                        });
                    });
                </script>

<?php   } else {

            // just normal field
            switch ($value['DATA_TYPE']) {
                case 'int': ?>
                <div class="form-group">
                    <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                    <input class="form-control"
                            type="number"
                            <?=($value['COLUMN_NAME']=='id' ? ' readonly ' : ' ')?>
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            min="0" 
                            step="1" 
                            name="<?=$value['COLUMN_NAME']?>" 
                            placeholder="<?=$value['COLUMN_NAME']?>" 
                            value="<?=$data[0][$value['COLUMN_NAME']]?>">
                <?php break;
                case 'tinyint': ?>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" 
                            type="checkbox" 
                            name="<?=$value['COLUMN_NAME']?>" 
                            placeholder="<?=$value['COLUMN_NAME']?>"
                            <?=($data[0][$value['COLUMN_NAME']] ? ' checked' : '')?>>
                        <label class="form-check-label" for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?></label>
                    </div>            
                <?php break;
                case 'float': ?>
                <div class="form-group">
                    <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                    <input class="form-control" 
                            type="number" 
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            step="0.01" 
                            name="<?=$value['COLUMN_NAME']?>" 
                            placeholder="<?=$value['COLUMN_NAME']?>" value="<?=$data[0][$value['COLUMN_NAME']]?>">
                <?php break;
                case 'text': ?>
                <div class="form-group">
                    <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                    <textarea class="form-control" 
                            name="<?=$value['COLUMN_NAME']?>" 
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            placeholder="<?=$value['COLUMN_NAME']?>"><?=$data[0][$value['COLUMN_NAME']]?></textarea>
                <?php break;
                case 'longtext': ?>
                <div class="form-group">
                    <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                    <textarea class="form-control" 
                            name="<?=$value['COLUMN_NAME']?>" 
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            placeholder="<?=$value['COLUMN_NAME']?>"><?=$data[0][$value['COLUMN_NAME']]?></textarea>
                <?php break;
                case 'datetime': ?>
                <div class="form-group">
                    <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                    <input class="form-control" 
                            type="text" 
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            readonly 
                            name="<?=$value['COLUMN_NAME']?>" 
                            placeholder="<?=$value['COLUMN_NAME']?>" 
                            value="<?=$data[0][$value['COLUMN_NAME']]?>">
                <?php break;
                default: ?>
                <div class="form-group">
                    <label<?=($value['IS_NULLABLE']=='NO' ? ' class="field_required" ' : ' ')?>for="<?=$value['COLUMN_NAME']?>"><?=ucfirst(str_replace('_', ' ', $value['COLUMN_NAME']))?>:</label>
                    <input class="form-control" 
                            type="text"
                            <?=($value['IS_NULLABLE']=='NO' ? ' required ' : ' ')?>
                            <?=($value['CHARACTER_MAXIMUM_LENGTH'] ? ' maxlength="'.$value['CHARACTER_MAXIMUM_LENGTH'].'" ' : ' ')?>
                            name="<?=$value['COLUMN_NAME']?>" 
                            placeholder="<?=$value['COLUMN_NAME']?>" 
                            value="<?=$data[0][$value['COLUMN_NAME']]?>">
                <?php break;
            } // switch 
        } // if else ?>
        </div>
<?php } // foreach ?>
        <button type="submit" class="btn btn-primary">Save</button>
        <?=\Components\Token::getToken();?>
        <input type="hidden" name="table" value="<?=$params[0]?>">
    </form>
</main>