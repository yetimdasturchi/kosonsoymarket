<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lite extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() 
	{
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

	public function index()
	{
		redirect(base_url());
	}
	public function news($action='list', $id='')
	{
		switch ($action) {
			case 'view':
				if ($id!='') {
					$this->db->where('news_id', $id);
					$news = $this->db->get('news');
					if ($news->num_rows() > 0) {
						$news = $news->row_array();
						$category = $this->db->get_where('news_category', array('category_id' => $news['category_id']));
                    	if ($category->num_rows() > 0) {
							$category = $category->row_array();
							$category = " | ".$category['category_name'];
						}else{
							$category = '';
						}
						$html = '<article class="uk-article">
									<img data-src="'.str_replace('{base_url}', base_url(), $news['photo']).'" width="1800" height="1200" alt="" uk-img>
    								<h4><a class="uk-link-reset">'.$news['title'].'</a></h4>

    								<p class="uk-article-meta">'.date("H:i / d.m.Y", $news['date']).$category.'</p>
    								<hr>
    								<div class="uk-dropcap">'.preg_replace('/(<img\b[^><]*)>/i', '$1 width="1800" height="1200">', strip_tags($news['content'], '<p><li><ol><span><b><strong><em><div><img><iframe>')).'</div>
								</article>';
						echo $html;
					}else{
						echo $this->error();			
					}
				}else{
					echo $this->error();
				}
			break;
			
			default:
				$rowperpage = 20;
				$rowno = $id;
				if($rowno != 0){
          			$rowno = ($rowno-1) * $rowperpage;
        		}
        		$language = getDefaultLang();
        		$this->db->select('count(*) as allcount');
            	$this->db->from('news');
        		$this->db->where('language', $language);
            	$query = $this->db->get();
            	$result = $query->result_array();
            	$allcount = $result[0]['allcount'];
				$this->db->where('language', $language);
				$this->db->limit($rowperpage, $rowno);
				$this->db->order_by('date', 'desc');
				$news = $this->db->get('news');
				if ($news->num_rows() > 0) {
                	$news = $news->result_array();
                    $html = '<div class="ads-list">';
                    foreach ($news as $row) {
                    	$category = $this->db->get_where('news_category', array('category_id' => $row['category_id']));
                    	if ($category->num_rows() > 0) {
							$category = $category->row_array();
							$category = " | ".$category['category_name'];
						}else{
							$category = '';
						}
						if (my_strlen($row['title']) > 40) {
							$row['title'] = my_substr($row['title'], 0, 40).'...';
						}
   						$html .= '<a lite-page="news/view/'.$row['news_id'].'">
									<div class="ads-item">
										<div class="ads-item-content">
											<img src="'.str_replace('{base_url}', base_url(), $row['photo']).'" height="100" width="100">
											<div class="ads-item-list">
												<p class="ads-item-title" style="font-size:14px;font-weight: bold;">'.$row['title'].'</p><br>
												<p class="ads-item-date">'.date("H:i / d.m.Y", $row['date']).$category.'</p>
											</div>
										</div>
		 							</div>
								</a>';
					}
					$html .= '</div>';
					
				}

				$config['base_url'] = 'news/list';
      			$config['use_page_numbers'] = TRUE;
      			$config['display_pages'] = FALSE;
      			$config['total_rows'] = $allcount;
      			$config['per_page'] = $rowperpage;
 
     			$config['full_tag_open']    = '<ul class="uk-pagination">';
      			$config['full_tag_close']   = '</ul>';
      			$config['prev_link'] = '<span class="uk-margin-small-right" uk-pagination-previous></span> Avvalgi';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				$config['next_link'] = 'Keyingi <span class="uk-margin-small-left" uk-pagination-next></span>';
				$config['next_tag_open'] = '<li class="uk-margin-auto-left">';
				$config['next_tag_close'] = '</li>';
				$config['attributes'] = array('class' => 'pagination');
      			$config['first_link'] = false; 
    			$config['last_link']  = false;
    			$this->pagination->initialize($config);
        		$html .= $this->pagination->create_links();
				echo $html;
			break;
		}
	}
	public function ads($action='list', $id='')
	{
		switch ($action) {
			case 'view':
				if ($id!='') {
					$this->db->where_in('status', array('2', '3'));
					$this->db->where('post_id', $id);
					$post = $this->db->get('posts');
					if ($post->num_rows() > 0) {
						$post = $post->row_array();
						$post_category = $this->db->get_where('categories', array('category_id' => $post['category_id']));
                    	if ($post_category->num_rows() > 0) {
							$post_category = $post_category->row_array();
							$post_category_name = json_decode($post_category['name'], true);
							$category = " | ".$post_category_name[getDefaultLang()];
						}else{
							$category = '';
						}
						$images = $this->getPostImages($post['post_id'], 100);
						$image_html = '';
						if (is_array($images)) {
							foreach ($images as $image) {
								$image_html .= '<li><img data-src="'.$image.'" width="1800" height="1200" alt="" uk-cover uk-img="target: !.uk-slideshow-items"></li>';
							}
						}else{
							$image_html .= '<li><img data-src="'.$images.'" width="1800" height="1200" alt="" uk-cover uk-img="target: !.uk-slideshow-items"></li>';
						}
						$filters = json_decode($post['filter'], true);
						$filters_html = '';
                        if (is_array($filters)) {
                        	foreach ($filters as $key => $value) {
                            	$id = str_replace("filter_", "", $key);
                                $filter = $this->db->get_where('filters', array('filter_id' => $id));
                                if ($filter->num_rows() > 0) {
                                	$filter = $filter->row_array();
                                    $filter_name = json_decode($filter['filter_name'], true);
                                    $filter_content = json_decode($filter['content'], true);
                                    if (is_array($filter_name)) {
                                    	if ($filter['type'] == 'select' && $value !='' && $value != 'null') {
                                        	$filters_html .= '<div class="uk-grid-small" uk-grid><div class="uk-width-expand" uk-leader>'.$filter_name[getDefaultLang()].'</div><div>'.$value.'</div></div>';
                                        } 
                                        if ($filter['type'] == 'input' && $value !='' && $value != 'null') {
                                        	$filters_html .= '<div class="uk-grid-small" uk-grid><div class="uk-width-expand" uk-leader>'.$filter_name[getDefaultLang()].'</div><div>'.$value.'</div></div>';
                                        } 
                                	}
                            	}
                        	}
                        }
                        if ($post['price'] == 0) {
                        	$price = '';
                        }else{
                        	$price_options = json_decode($post['price_options'], true);
							if ($price_options['currency'] == 'sum') {
                            	$price_options['currency'] = 's';
                            }else if ($price_options['currency'] == 'usd') {
                            	$price_options['currency'] = '$';
                            }
                            if ($price_options['covenant'] == '0') {
                            	$price_options['covenant'] = "";
                            }else if ($price_options['covenant'] == '1') {
								$price_options['covenant'] = '('.get_phrase('covenant').')';
                            }
                            $price = number_format($post['price'], 0, ',', ' ').' '.$price_options['currency'].' '.$price_options['covenant'];
                            $price = '<div class="uk-grid-small" uk-grid>
    									<div class="uk-width-expand" uk-leader>Narxi</div>
    									<div>'.$price.'</div>
									</div>';
                        }
						$html = '<article class="uk-article">
									<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>

    									<ul class="uk-slideshow-items">
        									'.$image_html.'
    									</ul>

    									<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
    									<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
									</div>
    								<h4><a class="uk-link-reset" href="">'.$post['title'].'</a></h4>
									<p class="uk-article-meta uk-margin-remove">'.date("H:i / d.m.Y", strtotime($post['created_at'])).$category.'</p>
    								<article class="uk-comment uk-margin-small">
    									<header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
        									<div class="uk-width-auto">
        										<span class="uk-comment-avatar" uk-icon="icon: user; ratio: 2.5"></span>
        									</div>
        									<div class="uk-width-expand">
            									<h4 class="uk-text-small uk-comment-title uk-margin-remove"><a class="uk-link-reset" >'.$post['contact_name'].'</a></h4>
            									<h6 class="uk-margin-remove uk-text-muted">'.$post['address'].'</h6>
            									<ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                									<li><a>'.$post['phone'].'</a></li>
            									</ul>
        									</div>
    									</header>
									</article>
    								<hr>
    								'.$price.'
									'.$filters_html.'
    								<div class="uk-margin-small">'.$post['content'].'</div>
									</article>';
						echo $html;
					}else{
						echo $this->error();			
					}
				}else{
					echo $this->error();
				}
			break;
			
			default:
				$rowperpage = 20;
				$rowno = $id;
				if($rowno != 0){
          			$rowno = ($rowno-1) * $rowperpage;
        		}
        		$language = getDefaultLang();
        		$this->db->select('count(*) as allcount');
            	$this->db->from('posts');
        		$this->db->where_in('status', array('2', '3'));
            	$query = $this->db->get();
            	$result = $query->result_array();
            	$allcount = $result[0]['allcount'];
				$this->db->where_in('status', array('2', '3'));
				$this->db->limit($rowperpage, $rowno);
				$this->db->order_by('created_at', 'desc');
				$posts = $this->db->get('posts');
				if ($posts->num_rows() > 0) {
                	$posts = $posts->result_array();
                    $html = '<div class="ads-list">';
                    foreach ($posts as $row) {
                    	$post_images = $this->db->get_where('post_images', array('post_id' => $row['post_id']));
						$post_category = $this->db->get_where('categories', array('category_id' => $row['category_id']));
                    	if ($post_category->num_rows() > 0) {
							$post_category = $post_category->row_array();
							$post_category_name = json_decode($post_category['name'], true);
							$category = " | ".$post_category_name[getDefaultLang()];
						}else{
							$category = '';
						}
						if ($post_images->num_rows() > 0) {
							$post_images = $post_images->row_array();
                			if (file_exists('./uploads/ads/'.$post_images['filename'])) {
                        		$post_image = 'uploads/ads/'.$post_images['filename'];
                    		}else{
                    			$post_image = 'public/images/noimage.jpg';
                    		}
						}else{
							$post_image = 'public/images/noimage.jpg';
						}
						if (my_strlen($row['title']) > 40) {
							$row['title'] = my_substr($row['title'], 0, 40).'...';
						}
						$html .= '<a lite-page="/ads/view/'.$row['post_id'].'">
									<div class="ads-item">
										<div class="ads-item-content">
											<img src="'.base_url($post_image).'" height="100" width="100">
											<div class="ads-item-list">
												<p class="ads-item-title" style="font-size:14px;font-weight: bold;">'.$row['title'].'</p>
												<p class="ads-item-date">'.date("H:i / d.m.Y", strtotime($row['created_at'])).$category.'</p>
											</div>
										</div>
		 							</div>
								</a>';
					}
					$html .= '</div>';
					
				}

				$config['base_url'] = 'ads/list';
      			$config['use_page_numbers'] = TRUE;
      			$config['display_pages'] = FALSE;
      			$config['total_rows'] = $allcount;
      			$config['per_page'] = $rowperpage;
 
     			$config['full_tag_open']    = '<ul class="uk-pagination">';
      			$config['full_tag_close']   = '</ul>';
      			$config['prev_link'] = '<span class="uk-margin-small-right" uk-pagination-previous></span> Avvalgi';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				$config['next_link'] = 'Keyingi <span class="uk-margin-small-left" uk-pagination-next></span>';
				$config['next_tag_open'] = '<li class="uk-margin-auto-left">';
				$config['next_tag_close'] = '</li>';
				$config['attributes'] = array('class' => 'pagination');
      			$config['first_link'] = false; 
    			$config['last_link']  = false;
    			$this->pagination->initialize($config);
        		$html .= $this->pagination->create_links();
				echo $html;
			break;
		}
	}

	public function search($action='', $id='')
	{
		switch ($action) {
			case 'list':
				$data = $this->input->get();
				$rowno = $this->input->get('page');
				$rowperpage = 20;
        		$language = getDefaultLang();
        		$allcount = $this->get_posts($data, true)->num_rows();
        		$data['limit'] = $rowperpage;
        		$data['from'] = $this->input->get('page');
        		$posts = $this->get_posts($data);
        		
        		if ($posts->num_rows() > 0) {
                	$posts = $posts->result_array();
                    $html = '<div class="ads-list">';
                    foreach ($posts as $row) {
                    	$post_images = $this->db->get_where('post_images', array('post_id' => $row['post_id']));
						$post_category = $this->db->get_where('categories', array('category_id' => $row['category_id']));
                    	if ($post_category->num_rows() > 0) {
							$post_category = $post_category->row_array();
							$post_category_name = json_decode($post_category['name'], true);
							$category = " | ".$post_category_name[getDefaultLang()];
						}else{
							$category = '';
						}
						if ($post_images->num_rows() > 0) {
							$post_images = $post_images->row_array();
                			if (file_exists('./uploads/ads/'.$post_images['filename'])) {
                        		$post_image = 'uploads/ads/'.$post_images['filename'];
                    		}else{
                    			$post_image = 'public/images/noimage.jpg';
                    		}
						}else{
							$post_image = 'public/images/noimage.jpg';
						}
						if (my_strlen($row['title']) > 40) {
							$row['title'] = my_substr($row['title'], 0, 40).'...';
						}
						$html .= '<a lite-page="/ads/view/'.$row['post_id'].'">
									<div class="ads-item">
										<div class="ads-item-content">
											<img src="'.base_url($post_image).'" height="100" width="100">
											<div class="ads-item-list">
												<p class="ads-item-title" style="font-size:14px;font-weight: bold;">'.$row['title'].'</p>
												<p class="ads-item-date">'.date("H:i / d.m.Y", strtotime($row['created_at'])).$category.'</p>
											</div>
										</div>
		 							</div>
								</a>';
					}
					$html .= '</div>';
					
				}else{
					$html = $this->search('error');
				}
				$queries = $this->input->get(); unset($queries['page']);
				if (count($queries) > 0) {
              		$config['base_url'] = 'search/list?'.http_build_query($queries);
            	}else{
             		$config['base_url'] = 'search/list';
            	}
      			$config['use_page_numbers'] = TRUE;
      			$config['display_pages'] = FALSE;
      			$config['total_rows'] = $allcount;
      			$config['per_page'] = $rowperpage;
      			$config['page_query_string']    = TRUE;
           		$config['query_string_segment']= 'page';
 
     			$config['full_tag_open']    = '<ul class="uk-pagination">';
      			$config['full_tag_close']   = '</ul>';
      			$config['prev_link'] = '<span class="uk-margin-small-right" uk-pagination-previous></span> Avvalgi';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				$config['next_link'] = 'Keyingi <span class="uk-margin-small-left" uk-pagination-next></span>';
				$config['next_tag_open'] = '<li class="uk-margin-auto-left">';
				$config['next_tag_close'] = '</li>';
				$config['attributes'] = array('class' => 'pagination');
      			$config['first_link'] = false; 
    			$config['last_link']  = false;
    			$this->pagination->initialize($config);
        		$html .= $this->pagination->create_links();
				echo $html;
			break;
			case 'categories':
				$categories_html = '<option value="">Rukn</option>';
				$categories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => 0));
				if ($categories->num_rows() > 0) {
                	$categories = $categories->result_array();
                    foreach ($categories as $category) {
                        $subcategories = $this->db->get_where('categories', array('status' => 1, 'parent_id' => $category['category_id']));
                        $category['name'] = json_decode($category['name'], true);
                        if ($subcategories->num_rows() > 0) {
                        	$subcategories = $subcategories->result_array();
                            $categories_html .= '<optgroup label="'.$category['name'][getDefaultLang()].'">';
                            $categories_html .= '<option value="'.$category['category_id'].'">- Barchasi</option>';
                            foreach ($subcategories as $subcategory) {
                                	$subcategory['name'] = json_decode($subcategory['name'], true);
                            	$categories_html .= '<option value="'.$subcategory['category_id'].'">- '.$subcategory['name'][getDefaultLang()].'</option>';
                            }
                        	$categories_html .= "</optgroup>";
                        }else{
                            $categories_html .= '<option value="'.$category['category_id'].'">'.$category['name'][getDefaultLang()].'</option>';
                        }
                    }
                }
                return $categories_html;
			break;
			case 'filters':
				$filters_html = '';
				$filters = $this->db->order_by('sort', 'asc')->get_where('filters', array('category_id' => $id));
    			if ($filters->num_rows() > 0) {
    				foreach ($filters->result_array() as $filter) {
    					$filter['filter_name'] = json_decode($filter['filter_name'], true);
    					if ($filter['type'] == 'select') {
    						$filter['content'] = json_decode($filter['content'], true);
    						$filters_html .= '<div class="uk-width-1-1"><select class="uk-select" palceholder="'.$filter['filter_name'][getDefaultLang()].'" name="filter['.$filter['filter_id'].']" '.filter_options($filter['options'], 'required', true).' '.filter_options($filter['options'], 'multiple', true).' '.filter_options($filter['options'], 'class', true).' '.filter_options($filter['options'], 'id', true).'>';
							$filters_html .= '<option value="">'.$filter['filter_name'][getDefaultLang()].'</option>';
							if (is_array($filter['content'][getDefaultLang()])) {
                   				foreach ($filter['content'][getDefaultLang()] as $row) {
                   					if (filter_options($filter['options'], 'selected') == $row['value']) {
                   						$filters_html .= '<option value="'.$row['value'].'" selected="">'.$row['label'].'</option>';
                   					}else{
                   						$filters_html .= '<option value="'.$row['value'].'">'.$row['label'].'</option>';
                   					}
                   				}
                   			}
    						
    						$filters_html .= '</select></div>';
    					}
    					if ($filter['type'] == 'input') {
          					$value = filter_options($filter['options'], 'value');
          					$filters_html .= '<div class="uk-width-1-1">
        						<input class="uk-input" type="'.filter_options($filter['options'], 'type').'" placeholder="'.$filter['filter_name'][getDefaultLang()].'" value="'.$value.'" name="filter['.$filter['filter_id'].']" '.filter_options($filter['options'], 'min', true).' '.filter_options($filter['options'], 'max', true).' '.filter_options($filter['options'], 'class', true).' '.filter_options($filter['options'], 'id', true).' '.filter_options($filter['options'], 'required', true).' '.filter_options($filter['options'], 'readonly', true).' '.filter_options($filter['options'], 'maxlength', true).' '.filter_options($filter['options'], 'minlength', true).'>
    						</div>';
          				}
          			}
          		}
          		echo $filters_html;
			break;
			
			default:
				$html = '';
				if ($action == 'error') {
					$html .= '<div class="uk-alert-danger" uk-alert>
    							<a class="uk-alert-close" uk-close></a>
    							<p>Kechirasiz sizning so\'rovingizga binoan hech qanday ma\'lumot topilmadi!</p>
							</div>';
				}
				$html.='<form class="uk-grid-small search" method="get" uk-grid>
    					<div class="uk-width-1-1">
        					<select class="uk-select" id="category-select" name="category">
                				'.$this->search('categories').'
            				</select>
    					</div>
    					<div class="uk-margin-small-top uk-margin-small-bottom uk-width-1-1 filters">
    					</div>
    					<div class="uk-width-1-2@s">
        					<input class="uk-input" type="text" name="query" placeholder="Kalit so\'z...">
    					</div>
    					<div class="uk-width-1-4@s">
        					<input class="uk-input" type="number" name="min" min="0" step="1000" placeholder="Minimal summa">
    					</div>
    					<div class="uk-width-1-4@s">
        					<input class="uk-input" type="number" name="max" min="0" step="1000" placeholder="Maksimal summa">
    					</div>
    					<div class="uk-margin-small uk-width-1-1">
    						<button class="uk-margin-small uk-button uk-button-default uk-width-1-1">Saralash</button>
    					</div>
					</form>';
					echo $html;
			break;
		}
		
	}
	public function add($action='', $id='')
	{
		switch ($action) {
			case 'submit':
				echo $this->postad($_POST, $_FILES);
			break;
			
			default:
				$pricing_html = '';
				$pricing = $this->Model_core->pricing();
				if ($pricing->num_rows() > 0) {
                	$pricing = $pricing->result_array();
                    foreach ($pricing as $row) {
                    	$name = json_decode($row['name'], true);
                        if (is_array($name)) {
                        	$name = $name[getDefaultLang()];
                        }else{
                        	$name = '';
                        }
                        $pricing_html .= '<option value="'.$row['price_id'].'">'.$name.' ('.number_format($row['price']).') so\'m</option>';
                    }
                }
				$html='<form class="uk-grid-small postad" enctype="multipart/form-data" method="post" uk-grid>
    					<div class="uk-width-1-1">
        					<input class="uk-input" type="text" name="title" placeholder="Sarlavha...">
    					</div>
    					<div class="uk-width-1-1">
        					<select class="uk-select" id="category-select" name="category">
                				'.$this->search('categories').'
            				</select>
    					</div>
    					<div class="uk-margin-small-top uk-margin-small-bottom uk-width-1-1 filters">
    					</div>
    					<div class="uk-width-1-2@s">
        					<input class="uk-input" type="number" name="price" placeholder="Narx...">
    					</div>
    					<div class="uk-width-1-4@s">
        					<select class="uk-select" name="currency">
                				<option value="sum">Valyuta</option>
                				<option value="sum">so‘m</option>
                                <option value="usd">$</option>
            				</select>
    					</div>
    					<div class="uk-width-1-4@s">
        					<select class="uk-select" name="covenant">
                				<option value="0">Kelishuv</option>
                				<option value="0">Odatiy</option>
                                <option value="1">Kelishilgan</option>
            				</select>
    					</div>
    					<div class="uk-width-1-1">
        					<textarea class="uk-textarea" name="content" rows="3" placeholder="Tasnif..."></textarea>
    					</div>
    					<div class="uk-width-1-1" style="padding-right: 25px;">
        					<input type="file" class="dropify" multiple="" accept="image/*" data-show-remove="false" data-show-errors="false" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="5M" name="files[]">
    					</div>
    					<div class="uk-width-1-2@s">
        					<input class="uk-input" type="text" name="onwer_name" placeholder="Ismingiz...">
    					</div>
    					<div class="uk-width-1-2@s">
        					<input class="uk-input" type="tel" name="onwer_phone" placeholder="Telefon raqam...">
    					</div>
    					<div class="uk-width-1-2@s">
       						<input class="uk-input" type="text" name="onwer_email" placeholder="Email yoki telegram manzil">
    					</div>
    					<div class="uk-width-1-2@s">
        					<input class="uk-input" type="text" name="onwer_address" placeholder="Manzil">
    					</div>
    					<div class="uk-width-1-2@s">
        					<select class="uk-select" name="service_type">
                				<option value="0">Xizmat turi</option>
                				'.$pricing_html.'
            				</select>
    					</div>
    					<div class="uk-width-1-2@s">
    						<button class="uk-margin-small uk-button uk-button-default uk-width-1-1">Kiritish</button>
    					</div>
					</form><script type="text/javascript">$(\'.dropify\').dropify();</script>';
					echo $html;
			break;
		}
		
	}
	public function info($action='')
	{
		$this->load->view('lite/info');
	}
	public function image()
	{
		$info = getimagesize($this->input->get('file'));
		$imgtype = image_type_to_mime_type($info[2]);
  		if ($imgtype == "image/png") {
  			header("Content-type: image/png");
  			readfile($this->input->get('file'));
  		}else{
  			header("Content-type: image/jpeg");
			$data = $this->input->get();
			echo $this->image_handler($data);
  		}
	}
	private function getPostImages($post_id='', $limit=3)
    {
        $images = array();
        if ($post_id != '') {
            $post_images = $this->db->limit($limit)->get_where('post_images', array('post_id' => $post_id));
            if ($post_images->num_rows() > 0) {
                $post_images = $post_images->result_array();
                foreach ($post_images as $image) {
                    if (file_exists('./uploads/ads/'.$image['filename'])) {
                        $images[] = base_url().'uploads/ads/'.$image['filename'];
                    }
                }
                if (count($images) == 0) {
                    return base_url().'public/images/noimage.jpg';
                }else{
                    return $images;
                }
            }else{
                return base_url().'public/images/noimage.jpg';
            }
        }else{
            return base_url().'public/images/noimage.jpg';
        }
    }
    private function get_posts($data='', $allcount = false)
    {
        
        if (array_key_exists('position', $data)) {$position = $data['position'];}else{$position = 'default';}
        if (array_key_exists('status', $data)) {$status = $data['status'];}else{$status = 2;}
        if (array_key_exists('list', $data)) {$list = $data['list'];}else{$list = 'list';}
        if (array_key_exists('sort', $data)) {$sort = $data['sort'];}else{$sort = 'default';}
        if (array_key_exists('category', $data)) {$category = $data['category'];}else{$category = '0';}
        if (array_key_exists('query', $data)) {$query = $data['query'];}else{$query = '';}
        if (array_key_exists('min', $data)) {$min = $data['min'];}else{$min = '0';}
        if (array_key_exists('max', $data)) {$max = $data['max'];}else{$max = '0';}
        if (array_key_exists('limit', $data)) {$limit = $data['limit'];}else{$limit = 20;}
        if (array_key_exists('from', $data)) {$from = $data['from'];}else{$from = 0;}

        if($from != 0){$from = ($from-1) * $limit;}

        if (array_key_exists('filter', $data)) {
            $filters = $data['filter'];
        }else{
            $filters ='';
        }
        if ($category != 0) {
            $this->db->where('category_id', $category);
        }

        if ($query != '') {
            $this->db->like('title', $query);
        }

        if ($min != 0) {
            $this->db->where('price >=', $min);
        }

        if ($max != 0){
            $this->db->where('price <=', $max);
        }
        
        if ($position == 'default') {
            $this->db->where_in('position', array('default', 'main', 'featured'));
        }else if($position == 'main'){
            $this->db->where('position_period >=', date("Y-m-d H:i:s"));
            $this->db->where_in('position', array('main'));
        }else if($position == 'featured'){
            $this->db->where('position_period >=', date("Y-m-d H:i:s"));
            $this->db->where_in('position', array('main', 'featured'));
        }


        if ($filters != '') {
            foreach ($filters as $key => $value) {
                $filter_content = ' `"filter_'.$key.'":"[^"]*[[:<:]]'.$value.'[[:>:]]`';
                $this->db->where('filter REGEXP ', '\'"filter_'.$key.'":"[[:<:]]'.$value.'[[:>:]]"\'', FALSE);
            }
        }
        
        if ($status==2) {
            $this->db->where_in('status', array('2', '3'));
        }else{
            $this->db->where('status', $status);
        }
        if ($sort == 'default') {
            $this->db->order_by('created_at', 'DESC');
        }else if ($sort == 'cheap') {
            $this->db->order_by('price', 'ASC');
        }else if ($sort == 'expensive') {
            $this->db->order_by('price', 'DESC');
        }else if ($sort == 'new') {
            $this->db->order_by('created_at', 'DESC');
        }else if ($sort == 'old') {
            $this->db->order_by('created_at', 'ASC');
        }else if ($sort == 'name_az') {
            $this->db->order_by('title', 'ASC');
        }else if ($sort == 'name_za') {
            $this->db->order_by('title', 'DESC');
        }else if ($sort == 'rand') {
            $this->db->order_by('rand()');
        }

        if ($allcount == false) {
            if ($position='default') {
                $this->db->limit($limit, $from);
            }else if ($position='featured') {
                $this->db->limit(20, 0);
            }else if ($position='main') {
                $this->db->limit(20, 0);
            }
        }

        return $this->db->get('posts');
    }

    public function error()
    {
    	$html = '<link rel="stylesheet" href="'.base_url('public').'/css/error.css">
				<div class="mars"></div>
				<img src="'.base_url('public').'/images/error/404.svg" class="logo-404" />
				<img src="'.base_url('public').'/images/error/meteor.svg" class="meteor" />
				<p class="title">Tizimda xatolik yuzberdi!</p>
				<p class="subtitle">
				Siz so\'rayotgan sahifa o\'chirilgan yoki boshqa manzilga ko\'chirilgan. Iltimos sahifa manzilini tekshirib qaytadan kirishga urinib ko\'ring.
				</p>
				<img src="'.base_url('public').'/images/error/astronaut.svg" class="astronaut" />
				<img src="'.base_url('public').'/images/error/spaceship.svg" class="spaceship" />';
    	return $html;
    }
    public function postad($data, $files)
  {
    if ($data && $files) {
      $title = $data['title'];
      $category = $data['category'];
      if ($category == null) {$category = 0;}
      $price = $data['price'];
      if ($price == null) {$price = 0;}
      $currency = $data['currency'];
      if ($currency == null) {$currency = 0;}
      $covenant = $data['covenant'];
      if ($covenant == null) {$covenant = 0;}
      $content = $data['content'];
      $onwer_name = $data['onwer_name'];
      $onwer_phone = $data['onwer_phone'];
      $onwer_email = $data['onwer_email'];
      $onwer_address = $data['onwer_address'];
      $service_type = $data['service_type'];
      if ($service_type == null) {$service_type = 0;}
      if (strlen($title) < 5 || $category == '0' || strlen($content) < 8 || strlen($onwer_name) < 3 || strlen($onwer_phone) < 3 || strlen($onwer_address) < 3 || $service_type == '0') {
        $return = array('status' => 'error', 'message' => '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>Kechirasiz kerakli maydonlar to\'ldirilmadi.</p></div>');
		echo json_encode($return);
      }else{
      	$filters = "";
        if (array_key_exists('filter', $data)) {
          $filters = array();
          if (count($data['filter']) > 0) {
            foreach ($data['filter'] as $key => $value) {
              if ($key != '' && $value !='') {
                $filters['filter_'.$key] = $value;
              }
            }
            $filters = json_encode($filters);
          }else{
            $filters = "";
          }
          
        }
        
        $data_array = array(
          'title' => $title,
          'content' => $content,
          'price' => $price,
          'price_options' => json_encode(array('currency' => $currency, 'covenant' => $covenant)),
          'contact_name' => $onwer_name,
          'email' => $onwer_email,
          'phone' => $onwer_phone,
          'address' => $onwer_address,
          'pricing_id' => $service_type,
          'filter' => $filters,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
          'deleted_at' => date('Y-m-d H:i:s'),
          'status' => 1,
          'visits' => 0,
          'template' => 'default',
          'position' => 'default',
          'position_period' => date('Y-m-d H:i:s'),
          'category_id' => $category,
          'user_id' => 1
        );

        $this->db->insert('posts', $data_array);
        $insert_id = $this->db->insert_id();

        if (count($files['files']['name']) > 0) {
          $this->load->library( 'image_lib' );
          foreach ($files['files']['name'] as $key => $value) {
            $filename = $value;
            $file_basename = substr($filename, 0, strripos($filename, '.'));
            $file_ext = substr($filename, strripos($filename, '.'));
            $newfilename = md5($file_basename.time().uniqueKey()) . $file_ext;
            $target_dir = './uploads/ads/';
            if (move_uploaded_file($files['files']["tmp_name"][$key], $target_dir.$newfilename)) {
              $image_data = array(
                'post_id' => $insert_id,
                'name' => $value,
                'size' => $files['files']["size"][$key],
                'filename' => $newfilename,
                'status' => 1
              );
              $this->db->insert('post_images', $image_data);
              image_handler($target_dir.$newfilename,$target_dir.$newfilename,800,600,90,'./public/images/watermark.png');
            }
          }
        }

        $return = array('status' => 'success', 'message' => '<div class="uk-alert-primary" uk-alert><a class="uk-alert-close" uk-close></a><p>E\'lon muvaffaqiyatli qo\'shildi. Tez orada operatorlarimiz siz bilan bog\'lanishadi albatta.</p></div>');
		echo json_encode($return);

      }
    }else{
      	$return = array('status' => 'error', 'message' => '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>Kechirasiz kerakli maydonlar to\'ldirilmadi.</p></div>');
		echo json_encode($return);
    }
  }
  private function image_handler($data) {
    	if (array_key_exists('file', $data)) {
    		$source_image = base_url().$data['file'];
    		if(@getimagesize($source_image)){
				$source_image = base_url().$data['file'];
			}else{
    			$source_image = base_url()."public/images/noimage.jpg";
			}
    	}else{
    		$source_image = base_url()."public/images/noimage.jpg";
    	}
    	if (array_key_exists('quality', $data)) {
    		$quality = $data['quality'];
    	}else{
    		$quality = 80;
    	}
    	if (array_key_exists('width', $data)) {
    		$tn_w = $data['width'];
    	}else{
    		$tn_w = 750;
    	}
    	if (array_key_exists('height', $data)) {
    		$tn_h = $data['height'];
    	}else{
    		$tn_h = 420;
    	}
    	if (array_key_exists('wmsource', $data)) {
    		$wmsource = $data['wmsource'];
    	}else{
    		$wmsource = false;
    	}
  		$info = getimagesize($source_image);
  		$imgtype = image_type_to_mime_type($info[2]);

  		switch ($imgtype) {
  			case 'image/jpeg':
  				$source = imagecreatefromjpeg($source_image);
  			break;
  			case 'image/gif':
  				$source = imagecreatefromgif($source_image);
  			break;
  			case 'image/png':
  				$source = imagecreatefrompng($source_image);
  			break;
  			default:
  				die('Invalid image type.');
  		}

  		$src_w = imagesx($source);
  		$src_h = imagesy($source);
  		$src_ratio = $src_w/$src_h;

  		if ($tn_w/$tn_h > $src_ratio) {
  			$new_h = $tn_w/$src_ratio;
  			$new_w = $tn_w;
 		} else {
  			$new_w = $tn_h*$src_ratio;
  			$new_h = $tn_h;
  		}
  		$x_mid = $new_w/2;
  		$y_mid = $new_h/2;

  		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
  		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
  		$final = imagecreatetruecolor($tn_w, $tn_h);
  		imagecopyresampled($final, $newpic, 0, 0, ($x_mid-($tn_w/2)), ($y_mid-($tn_h/2)), $tn_w, $tn_h, $tn_w, $tn_h);

  		if($wmsource) {
  			$info = getimagesize($wmsource);
  			$imgtype = image_type_to_mime_type($info[2]);
  			switch ($imgtype) {
  				case 'image/jpeg':
    				$watermark = imagecreatefromjpeg($wmsource);
    			break;
  				case 'image/gif':
    				$watermark = imagecreatefromgif($wmsource);
    			break;
  				case 'image/png':
    				$watermark = imagecreatefrompng($wmsource);
    			break;
  				default:
    				die('Invalid watermark type.');
  			}

  			$wm_w = imagesx($watermark);
  			$wm_h = imagesy($watermark);

  			$wm_x = $tn_w - $wm_w;
  			$wm_y = $tn_h - $wm_h;

  			imagecopy($final, $watermark, $wm_x, $wm_y, 0, 0, $tn_w, $tn_h);
  		}

  		$result = Imagejpeg($newpic,NULL,$quality);
  		imagedestroy($result);
  		return $result;
	}
}
