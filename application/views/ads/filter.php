<?php
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
				<div class="col-md-<?=$col_md;?> col-xs-6 col-sm-4 no-padding custom-filter">
        			<select class="category form-control custom-filter" palceholder="<?=$filter['filter_name'][getDefaultLang()]?>" name="filter[<?=$filter['filter_id'];?>]" <?=filter_options($filter['options'], 'required', true)?> <?=filter_options($filter['options'], 'multiple', true)?> <?=filter_options($filter['options'], 'class', true)?> <?=filter_options($filter['options'], 'id', true)?>>
                   		<option value=""><?=$filter['filter_name'][getDefaultLang()]?></option>
                   		<?php
                   			if (is_array($filter['content'][getDefaultLang()])) {
                   				foreach ($filter['content'][getDefaultLang()] as $row) {
                   					if (filter_options($filter['options'], 'selected') == $row['value']) {
                   						echo '<option value="'.$row['value'].'" selected="">'.$row['label'].'</option>';
                   					}else{
                              if (array_key_exists('filter', $_POST)) {
                                if (isset($_POST['filter'][$filter['filter_id']])) {
                                  if ($_POST['filter'][$filter['filter_id']] == $row['value']) {
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
          if (array_key_exists('filter', $_POST)) {
            if (isset($_POST['filter'][$filter['filter_id']])) {
              $value = $_POST['filter'][$filter['filter_id']];
            }else{
              $value = filter_options($filter['options'], 'value');
            }
          }else{
            $value = filter_options($filter['options'], 'value');
          }
?>
				<div class="col-md-<?=$col_md;?> col-xs-6 col-sm-4 no-padding">
        			<input type="<?=filter_options($filter['options'], 'type');?>" class="custom-filter form-control" placeholder="<?=$filter['filter_name'][getDefaultLang()]?>" value="<?=$value?>" name="filter[<?=$filter['filter_id'];?>]" <?=filter_options($filter['options'], 'min', true)?> <?=filter_options($filter['options'], 'max', true)?> <?=filter_options($filter['options'], 'class', true)?> <?=filter_options($filter['options'], 'id', true)?> <?=filter_options($filter['options'], 'required', true)?> <?=filter_options($filter['options'], 'readonly', true)?> <?=filter_options($filter['options'], 'maxlength', true)?> <?=filter_options($filter['options'], 'minlength', true)?> />
    			</div>
<?
    		}
    	}
    }
    
?>