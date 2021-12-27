<?
  $images = $this->Model_core->getPostImages($item['post_id'], 100);
?>
<div>
<div class="owl-carousel owl-theme my-carousel full-width">
	<?
		if (is_array($images)) {
			foreach ($images as $image) {
    ?>
				<div class="item">
    				<img src="<?=$image;?>" alt=""/>
    			</div>
    <?
    		}
    	}else{
    ?>
    		<div class="item">
    			<img src="<?=$images;?>" alt="" />
    		</div>
    <?		
    	}
    ?>
</div></div>