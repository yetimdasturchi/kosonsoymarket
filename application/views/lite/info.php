<div class="uk-panel uk-margin-bottom">
    <img class="uk-align-center uk-align-right@m uk-margin-remove-adjacent"  src="<?=base_url('public/images/project_at_work.png')?>" width="225" height="150">
    <?php
            $data = json_decode(setting_item('about_site'), true);
            if (is_array($data)) {
            	echo strip_tags($data[getDefaultLang()], '<p><span><bold><i><em><u>');
        	}
		?>
</div>
<hr>
<div class="uk-grid-small" uk-grid>
    <div class="uk-width-expand" uk-leader>Umumiy e'lonlar</div>
    <div><?=$this->db->count_all_results('posts');?></div>
</div>
<div class="uk-grid-small" uk-grid>
    <div class="uk-width-expand" uk-leader>Faol e'lonlar</div>
    <div><?=$this->db->where('status', 2)->count_all_results('posts');?></div>
</div>
<div class="uk-grid-small" uk-grid>
    <div class="uk-width-expand" uk-leader>Umumiy foydalanuvchilar</div>
    <div><?=gettelegramUsers();?></div>
</div>
<div class="uk-grid-small" uk-grid>
    <div class="uk-width-expand" uk-leader>Kunlik kuzatuvchilar</div>
    <div><?=gettelegramUsers('daily');?></div>
</div>
<h3 class="uk-heading-divider uk-text-center">Pullik Xizmatlar</h3>
<p class="uk-text-center uk-text-muted">Endi sizning eʼloningiz uchun qaysi xizmat yaxshiroq natija berishi haqida oʻylab oʻtirishingizga xojat yoʻq. Faqatgina uni qay darajada koʻzga tashlanadigan qilish va qanchalar tezroq bitim tuzish istagida ekaningiz toʻgʻrisida qaror qabul qilsangiz bas!</p>
<div class="uk-grid-match uk-child-width-expand@s uk-text-center uk-margin-top" uk-grid>
    	<?
    		$data = $this->Model_core->pricing();
			if ($data->num_rows() > 0) {
            	$data = $data->result_array();
                foreach ($data as $row) {
                	$name = json_decode($row['name'], true);
                    if (is_array($name)) {
                    	$name = $name[getDefaultLang()];
                    }else{
                    	$name = '';
                    }
                    $subtitle = json_decode($row['subtitle'], true);
                    if (is_array($subtitle)) {
                    	$subtitle = $subtitle[getDefaultLang()];
                    }else{
                    	$subtitle = '';
                    }
					$content = json_decode($row['content'], true);
    	?>
        			<div><div class="uk-card uk-card-default uk-card-small uk-card-body" style="box-shadow: unset;">
            			<h5 class="uk-card-title"><?=$name;?></h5>
            			<p>
            				<ul class="uk-list uk-list-bullet uk-text-left">
    							<?php
                                    if (is_array($content)) {
                                       foreach ($content[getDefaultLang()] as $single) {
                                          echo "<li>{$single}</li>";
                                       }
                                    }
                                    
                                 ?>
							</ul>
            			</p>
        			</div></div>
        <?
        		}
        	}
        ?>
</div>
<hr>
<div class="uk-panel uk-margin-bottom">
    <img class="uk-align-center uk-align-right@m uk-margin-remove-adjacent"  src="<?=base_url('public/images/project_at_adversitement.png')?>" width="225" height="150">
    <?php
            $data = json_decode(setting_item('advertisement'), true);
            if (is_array($data)) {
            	echo strip_tags($data[getDefaultLang()], '<p><span><bold><i><em><u>');
        	}
		?>
</div>
<hr>
<ul class="uk-list uk-list-divider">
    <li>Dastur versiyasi: 1.0.1</li>
    <li>Litsenziya: Bepul</li>
    <li>Ishlab chiqarilgan sana: 18.11.2019</li>
    <li>Ishlab chiqaruvchi: DEVCON P/E</li>
    <li>Dasturchi: Manuchehr Usmonov</li>
    <li>Web sayt: www.devcon.uz</li>
    <li>Aloqa ma'lumotlari: +99891 180-50-15, support@devcon.uz</li>
</ul>