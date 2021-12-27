<?
$languages = $this->config->item('languages_list');
                        $category = $this->Model_core->news_categories($item['category_id']);
                        if ($category->num_rows() > 0) {
                          $category = $category->first_row('array');;
                          $category = $category['category_name'];
                        }else{
                          $category = '';
                        }
?>
<div>
	<ul class="list-arrow">
		<li><b>Til:</b> <em><?=$languages[$item['language']]?></em></li>
    <li><b>Sana:</b> <em><?=dateformat($item['date']);?></em></li>
    <li><b>Rukn:</b> <em><?=$category;?></em></li>
	</ul>
</div>