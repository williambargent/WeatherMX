<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Breadcrumbs Class
 *
 * This class manages the breadcrumb object
 *
 * @package		Breadcrumb
 * @version		1.0
 * @author 		Buti <buti@nobuti.com>
 * @copyright 	Copyright (c) 2012, Buti
 * @link		https://github.com/nobuti/codeigniter-breadcrumb
 */

$config['crumb_divider'] = '<span class="divider">&nbsp;/</span>';
$config['tag_open'] = '<ul class="nav mr-auto">';
$config['tag_close'] = '</ul>';
$config['crumb_open'] = '<li class="nav-item breadcrumb">';
$config['crumb_last_open'] = '<li class="nav-item breadcrumb active">';
$config['crumb_close'] = '</li>';