<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array();
$config["base_url"] = base_url();
$config["total_rows"] = 0;
$config["per_page"] = 10;
$config["uri_segment"] = 3;
$config["use_page_numbers"] = TRUE;
$config["full_tag_open"] = '<ul class="pagination">';
$config["full_tag_close"] = '</ul>';
$config["first_tag_open"] = '<li class=page-item>';
$config["first_tag_close"] = '</li>';
$config["last_tag_open"] = '<li class=page-item>';
$config["last_tag_close"] = '</li>';
$config['next_link'] = '&gt;';
$config["next_tag_open"] = '<li class=page-item>';
$config["next_tag_close"] = '</li>';
$config["prev_link"] = "&lt;";
$config["prev_tag_open"] = "<li class=page-item>";
$config["prev_tag_close"] = "</li>";
$config["cur_tag_open"] = "<li class='page-item active'><a class='page-link' href='#'>";
$config["cur_tag_close"] = "</a></li>";
$config["num_tag_open"] = "<li class=page-item>";
$config["num_tag_close"] = "</li>";
$config['attributes'] = array('class' => 'page-link');
$config["num_links"] = 1;
$config['enable_query_strings'] = TRUE;