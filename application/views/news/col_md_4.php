<?
   $category = $this->Model_core->news_categories($data['category_id']);
   if ($category->num_rows() > 0) {
      $category = $category->first_row('array');;
      $category = '<a href="'.base_url('p/news/category/'.$category['category_id']).'">'.$category['category_name'].'</a>';
   }else{
      $category = '';
   }
?>
<!-- Blog Post-->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="blog-post">
                              <div class="post-img">
                                 <a href="{base_url}p/news/view/<?=$data['news_id'];?>-<?=$data['slug'];?>"> <img class="post-img-wrap img-responsive " alt="" src="<?=$data['photo'];?>"> </a>
                              </div>
                              <div class="post-info"> <a href=""><?=dateformat($data['date'])?></a> <?=$category;?> </div>
                              <h3 class="post-title"> <a href="{base_url}p/news/view/<?=$data['news_id'];?>-<?=$data['slug'];?>"> <?=$data['title']?></a> </h3>
                              <p class="post-excerpt"> <?=shorttext($data['content'], '127')?> </p>
                           </div>
                        </div>