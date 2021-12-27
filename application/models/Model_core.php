<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_core extends CI_Model 
{
    public function partner_show($id='')
    {
    	if ($id != '') {
    		$this->db->where('partner_id', $id);
    	}

    	$this->db->order_by('partner_id', 'asc');

    	return $this->db->get('partners');
    }

    public function news($id='', $limit='10', $from='', $order='desc')
    {
    	if ($id != '') {
    		$this->db->where('news_id', $id);
    	}
        $this->db->where('language', getDefaultLang());
    	if ($limit != '' && $from != '') {
            $this->db->limit($limit, $from);    
        }else if ($limit != ''){
            $this->db->limit($limit);
        }

        if ($order == 'rand') {
            $this->db->order_by('rand()');
        }else{
            $this->db->order_by('date', $order);
        }

    	return $this->db->get('news');
    }

    public function categories($id='', $limit='', $from='', $order='asc')
    {
    	if ($id != '') {
    		$this->db->where('category_id', $id);
    	}

    	if ($limit != '' && $from != '') {
            $this->db->limit($limit, $from);    
        }else if ($limit != ''){
            $this->db->limit($limit);
        }

        if ($order == 'rand') {
            $this->db->order_by('rand()');
        }else{
            $this->db->order_by('name', $order);
        }

    	return $this->db->get('categories');
    }

    public function pricing($id='', $order='asc')
    {
        if ($id != '') {
            $this->db->where('price_id', $id);
        }

        if ($order == 'rand') {
            $this->db->order_by('rand()');
        }else{
            $this->db->order_by('price', $order);
        }

        return $this->db->get('pricing');
    }

    public function news_categories($id='', $limit='', $from='', $order='asc')
    {
        if ($id != '') {
            $this->db->where('category_id', $id);
            $this->db->where('language', getDefaultLang());
        }else{
            $this->db->where('language', getDefaultLang());
        }

        if ($limit != '' && $from != '') {
            $this->db->limit($limit, $from);    
        }else if ($limit != ''){
            $this->db->limit($limit);
        }

        if ($order == 'rand') {
            $this->db->order_by('rand()');
        }else{
            $this->db->order_by('category_name', $order);
        }

        return $this->db->get('news_category');
    }

    public function getNewsRecordCount($category_id=0) {
        if ($category_id != 0) {
            $this->db->where('language', getDefaultLang());
            $this->db->where('category_id', $category_id);
            return $this->db->get('news')->num_rows();
        }else{
            $this->db->select('count(*) as allcount');
            $this->db->from('news');
            $this->db->where('language', getDefaultLang());
            $query = $this->db->get();
            $result = $query->result_array();      
            return $result[0]['allcount'];
        }
        
    }

    public function filters($action='', $id='')
    {
        switch ($action) {
            case 'single':
                return $this->db->order_by('sort', 'asc')->get_where('filters', array('filter_id' => $id));
            break;

            case 'category':
                return $this->db->order_by('sort', 'asc')->get_where('filters', array('category_id' => $id));
            break;
            
            default:
                return $this->db->get('filters');
            break;
        }
    }

    public function posts($data='', $status=2, $position='default', $allcount=false)
    {
        
        $_POST = $data;
        if (empty($_POST['list'])) {$list = 'list';}else{$list = $_POST['list'];}

        if (empty($_POST['sort'])) {$sort = 'default';}else{$sort = $_POST['sort'];}

        if (empty($_POST['category'])) {$category = '0';}else{$category = $_POST['category'];}
        
        if (empty($_POST['query'])) {$query = '';}else{$query = $_POST['query'];}

        if (empty($_POST['min'])) {$min = '0';}else{$min = $_POST['min'];}

        if (empty($_POST['max'])) {$max = '0';}else{$max = $_POST['max'];}

        if (empty($_POST['limit'])) {$limit = 12;}else{$limit = $_POST['limit'];}

        if (empty($_POST['from'])) {$from = 0;}else{$from = $_POST['from'];}

        if($from != 0){$from = ($from-1) * $limit;}

        if (array_key_exists('filter', $_POST)) {
            $filters = $_POST['filter'];
        }else{
            $filters ='';
        }
        if ($category != 0) {
            $this->db->where('category_id', $category);
        }

        if ($query != '') {
            $this->db->like('title', $query);
            $this->db->or_like('content', $query);
            $this->db->or_like('address', $query);
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
                $this->db->limit(12, 0);
            }else if ($position='main') {
                $this->db->limit(9, 0);
            }
        }

        return $this->db->get('posts');
    }

    public function postPagination($data='', $status=2, $position='default')
    {
        if (!isset($data['limit'])) {
            $data['limit'] = 12;
        }

        $allcount = $this->posts($data, $status, $position, true)->num_rows();
        
        $config['base_url'] = base_url().'ads';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $data['limit'];
        $config["cur_page"] = $data['from'];
 
        $config['full_tag_open']    = '<ul class="pagination pagination-lg">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['prev_link'] = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
        $config['next_link'] = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
        $config['first_link'] = false; 
        $config['last_link']  = false;
 
        $this->pagination->initialize($config);
 
        return $this->pagination->create_links();
    }

    public function getPostImages($post_id='', $limit=3)
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

    public function updateViews($post_id='')
    {
        if ($post_id != '') {
            $post = $this->db->get_where('posts', array('post_id' => $post_id));
            if ($post->num_rows() > 0) {
                $post = $post->row_array();
                $views = $post['visits']+1;
                $this->db->update('posts', array('visits' => $views), array('post_id' => $post_id));
            }
        }
    }

    public function resize_image($filename='')
    {
        if ($filename != '') {
            $config['image_library'] = 'gd2';
            $config['source_image'] = $filename;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 750;
            $config['height'] = 420;
            $config['wm_opacity'] = '100';
            $config['wm_vrt_alignment'] = 'bottom';
            $config['wm_hor_alignment'] = 'right';
            $config['wm_vrt_offset'] = '100';
            $config['wm_overlay_path'] = './public/images/watermark.png';
            $config['wm_type'] = 'overlay';
            $this->load->library('image_lib');
            $this->image_lib->initialize($config);
            $this->image_lib->clear();

            $this->image_lib->resize();
            $this->image_lib->watermark();
        }
    }

    public function visit_platform($action='', $begin='', $end='')
    {
        if ($begin == '' && $end == '') {
            $begin = strtotime(date('Y-m-d').' 00:00:00');
            $end = strtotime(date('Y-m-d').' 23:59:59');
        }


        $this->db->where('date >=', $begin);
        $this->db->where('date <=', $end);
        $this->db->group_by('platform');

        $visitors = $this->db->get('visitors');
        $platform = array();

        foreach ($visitors->result_array() as $row) {
            $platform[] = $row['platform'];
        }

        $platform = array_unique($platform, SORT_STRING);
        $platform = array_values($platform);

        if ($action == 'count') {
            foreach ($platform as $key => $value) {
                $this->db->where('platform', $value);
                $this->db->where('date >=', $begin);
                $this->db->where('date <=', $end);
                $this->db->group_by('ip');
                $allcount = $this->db->get('visitors');
                $platform[$key] = $allcount->num_rows();
            }
            return $platform;
        }else{
            return $platform;
        }
    }

    public function visit_browser($action='', $begin='', $end='')
    {
        if ($begin == '' && $end == '') {
            $begin = strtotime(date('Y-m-d').' 00:00:00');
            $end = strtotime(date('Y-m-d').' 23:59:59');
        }


        $this->db->where('date >=', $begin);
        $this->db->where('date <=', $end);
        $this->db->group_by('browser_name');

        $visitors = $this->db->get('visitors');
        $browser_name = array();

        foreach ($visitors->result_array() as $row) {
            $browser_name[] = $row['browser_name'];
        }

        $browser_name = array_unique($browser_name, SORT_STRING);
        $browser_name = array_values($browser_name);

        if ($action == 'count') {
            foreach ($browser_name as $key => $value) {
                $this->db->where('browser_name', $value);
                $this->db->where('date >=', $begin);
                $this->db->where('date <=', $end);
                $this->db->group_by('ip');
                $allcount = $this->db->get('visitors');
                $browser_name[$key] = $allcount->num_rows();
            }
            return $browser_name;
        }else{
            return $browser_name;
        }
    }

    public function visit_views($group_by=false, $begin='', $end='')
    {
        if ($begin=='') {
            $begin = strtotime(date('Y-m-d').' 00:00:00');
        }
        if ($end=='') {
            $end = strtotime(date('Y-m-d').' 23:59:59');
        }


        $this->db->where('date >=', $begin);
        $this->db->where('date <=', $end);

        if ($group_by!=false) {
            $this->db->group_by($group_by);
        }

        $visitors = $this->db->get('visitors');
        
        return $visitors->num_rows();
    }

    public function visit_lastdays($begin='', $end='')
    {
        if ($begin == '' && $end == '') {
            $today =  date("Y-m-d");
            $count = array();
            for ($i=0; $i <= 7; $i++){ 
                $strData = date('Y-m-d', strtotime( '-'. $i .' days', strtotime($today)));
                $count[] = array(
                    'date' => $strData,
                    'visits' => $this->visit_views('ip', strtotime($strData.' 00:00:00'), strtotime($strData.' 23:59:59')),
                    'views' => $this->visit_views(false, strtotime($strData.' 00:00:00'), strtotime($strData.' 23:59:59')),
                );
            }
        }else{
            $datediff = $end - $begin;
            $datediff = floor($datediff/(60*60*24));
            for($i = 0; $i < $datediff + 1; $i++){
                $date = date('Y-m-d', $begin);
                $strData = date("Y-m-d", strtotime($date . ' + ' . $i . 'day'));
                $count[] = array(
                    'date' => $strData,
                    'visits' => $this->visit_views('ip', strtotime($strData.' 00:00:00'), strtotime($strData.' 23:59:59')),
                    'views' => $this->visit_views(false, strtotime($strData.' 00:00:00'), strtotime($strData.' 23:59:59')),
                );
            }
        }
        
        return $count;
    }

    
    public function visit_map_views($group_by=false, $begin='', $end='')
    {
        if ($begin=='') {
            $begin = strtotime(date('Y-m-d').' 00:00:00');
        }
        if ($end=='') {
            $end = strtotime(date('Y-m-d').' 23:59:59');
        }
        $data = array();
        foreach ($this->Model_core->visit_map('country_code', strtotime($begin.' 00:00:00'), strtotime($end.' 23:59:59'))->result_array() as $mapdata) {
            $this->db->where('date >=', $begin);
            $this->db->where('date <=', $end);
            $this->db->where('country_code', $mapdata['country_code']);
            if ($group_by!=false) {
                $this->db->group_by($group_by);
            }
            $query = $this->db->get('visitors');
            $query =  $query->num_rows();

            $data[$mapdata['country_code']] = $query;
        }
        return $data;
    }

    public function visit_map($begin='', $end='')
    {
        $count = array();
        if ($begin=='') {
            $begin = strtotime(date('Y-m-d').' 00:00:00');
        }
        if ($end=='') {
            $end = strtotime(date('Y-m-d').' 23:59:59');
        }
        $this->db->where('date >=', $begin);
        $this->db->where('date <=', $end);
        $this->db->group_by('country_code');
        $visitors = $this->db->get('visitors');
        foreach ($visitors->result_array() as $row) {
            $this->db->where('date >=', $begin);
            $this->db->where('date <=', $end);
            $this->db->where('country_code', $row['country_code']);
            $this->db->group_by('ip');
            $visits = $this->db->get('visitors');

            $this->db->where('date >=', $begin);
            $this->db->where('date <=', $end);
            $this->db->where('country_code', $row['country_code']);
            $views = $this->db->get('visitors');

            $count[$row['country_code']] = array(
                'visits' => $visits->num_rows(),
                'views' => $views->num_rows(),
            );
        }
        return $count;
    }
}