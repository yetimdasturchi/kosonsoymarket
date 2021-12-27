<?
  $filters = $this->Model_core->filters('category', $category_id);
  if ($filters->num_rows() > 0) {
    $col_md = array('1' => 12, '2' => 6, '3' => 4, '4' => 3, '6' => '4', '8' => '2', '10' => '3');
    if (array_key_exists($filters->num_rows(), $col_md)) {
      $col_md = $col_md[$filters->num_rows()];
    }else{
      $col_md = 2;
    }
    foreach ($filters->result_array() as $filter) {
      $filter['filter_name'] = json_decode($filter['filter_name'], true);
      if ($filter['type'] == 'select') {
        $filter['content'] = json_decode($filter['content'], true);
?>
        <div class="form-group col-md-<?=$col_md;?> col-sm-<?=$col_md;?> col-lg-<?=$col_md;?>">
          <label for="filter_<?=$filter['filter_id'];?>"><?=$filter['filter_name'][setting_item('default_language')]?></label>
          <select class="js-example-basic-single" id="filter_<?=$filter['filter_id'];?>" style="width:100%" name="filter[<?=$filter['filter_id'];?>]" <?=filter_options($filter['options'], 'required', true)?> <?=filter_options($filter['options'], 'multiple', true)?> <?=filter_options($filter['options'], 'class', true)?> <?=filter_options($filter['options'], 'id', true)?>>
            <option value="null">Tanlash</option>
            <?php
              if (is_array($filter['content'][setting_item('default_language')])) {
                foreach ($filter['content'][setting_item('default_language')] as $row) {
                  if (filter_options($filter['options'], 'selected') == $row['value']) {
                    echo '<option value="'.$row['value'].'" selected="">'.$row['label'].'</option>';
                  }else{
                    if (array_key_exists('filter', $data)) {
                      if (isset($data['filter'][$filter['filter_id']])) {
                        if ($data['filter'][$filter['filter_id']] == $row['value']) {
                          echo '<option value="'.$row['value'].'" selected="">'.$row['label'].'</option>';
                        }else{
                          echo '<option value="'.$row['value'].'">'.$row['label'].'</option>';
                        }
                      }else{
                        echo '<option value="'.$row['value'].'">'.$row['label'].'</option>';
                      }
                    }else{
                      echo '<option value="'.$row['value'].'">'.$row['label'].'</option>';
                    }
                  }
                }
              }
            ?>
          </select>
        </div>
<?
      }

      if ($filter['type'] == 'input') {
        if (array_key_exists('filter', $data)) {
          if (isset($data['filter'][$filter['filter_id']])) {
            $value = $data['filter'][$filter['filter_id']];
          }else{
            $value = filter_options($filter['options'], 'value');
          }
          }else{
            $value = filter_options($filter['options'], 'value');
          }
?>

          <div class="form-group col-md-<?=$col_md;?> col-sm-<?=$col_md;?> col-lg-<?=$col_md;?>">
            <label for="filter_<?=$filter['filter_id'];?>"><?=$filter['filter_name'][setting_item('default_language')]?></label>
            <input type="text" class="form-control" id="filter_<?=$filter['filter_id'];?>" name="filter[<?=$filter['filter_id'];?>]" placeholder="<?=$filter['filter_name'][setting_item('default_language')]?>..." value="<?=$value?>" <?=filter_options($filter['options'], 'min', true)?> <?=filter_options($filter['options'], 'max', true)?> <?=filter_options($filter['options'], 'class', true)?> <?=filter_options($filter['options'], 'id', true)?> <?=filter_options($filter['options'], 'required', true)?> <?=filter_options($filter['options'], 'readonly', true)?> <?=filter_options($filter['options'], 'maxlength', true)?> <?=filter_options($filter['options'], 'minlength', true)?>>
          </div>
<?
        }
      }
    }
  //}
?>  