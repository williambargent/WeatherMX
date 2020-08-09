<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WeatherMX - An elegant, free, open-source web application built to display data from CumulusMX; the weather stations data logger.
 * https://github.com/williambargent/WeatherMX
 *
 * @author William Bargent code@williambargent.co.uk
 * 
 * @copyright Copyright (c) 2018, William Bargent
 * @license AGPL-3.0
 * 
 *              GNU AFFERO GENERAL PUBLIC LICENSE
 *                 Version 3, 19 November 2007
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 * */
class Stations extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('stations_model', 'stations_model');
    }

    public function index() {
        // Page title
        $data['page_title'] = 'William Bargent';
        
        $data['all_stations'] = $this->stations_model->all_stations();
        $data['last_reported'] = $this->stations_model->stations_lastreported($data['all_stations']);
        
        $this->load->view('templates/header', $data);
        $this->load->view('index');
        $this->load->view('all_stations', $data);
        $this->load->view('index2');
        $this->load->view('templates/footer');
    }
    
    public function stations_redirect() {
        redirect(base_url('stations/all-stations'));
    }
    

    public function all_stations() {
        
        // Page title and breadcrumb
        $data['page_title'] = ucwords(str_replace('_', ' ', __FUNCTION__));
        $this->breadcrumbs->push(ucwords(str_replace('_', ' ', __CLASS__)), lcfirst(__CLASS__));
        $this->breadcrumbs->push($data['page_title'], lcfirst(str_replace('_', '-',__CLASS__.'/'.__FUNCTION__)));
        
        $data['all_stations'] = $this->stations_model->all_stations();
        $data['last_reported'] = $this->stations_model->stations_lastreported($data['all_stations']);

        $this->load->view('templates/header', $data);
        $this->load->view('all_stations', $data);
        $this->load->view('templates/footer');
    }
    
    public function stations() {
        
        $station_url = $_GET['location'];
        $data['all_stations'] = $all_stations = $this->stations_model->all_stations();

        // Does the station exist
        $loop = 0;
        foreach ($data['all_stations'] as $key => $station) {
            $loop++;
            if ($station['url'] == $station_url) {
                $found = TRUE;
                // Set loop count for station_id
                $data['station_id'] = $station_id = $loop - 1;
            }
        }

        if ($found == TRUE) {
            
            // Page title and breadcrumb
            $data['page_title'] = $data['all_stations'][$data['station_id']]['name'] . ' Station';
            $this->breadcrumbs->push(ucwords(str_replace('_', ' ', __CLASS__)), lcfirst(__CLASS__));
            $this->breadcrumbs->push($data['all_stations'][$data['station_id']]['name'], 'station?location=' . $station_url);
            
            $table_realtime = $data['all_stations'][$data['station_id']]['table_realtime'];
            $table_monthly = $data['all_stations'][$data['station_id']]['table_monthly'];
            $data['realtime_data'] = $this->stations_model->table_realtime($table_realtime);
            $data['today_data'] = $today_data = $this->stations_model->table_monthly($table_monthly);
            $data['dark_sky_forcast'] = $this->stations_model->dark_sky_forcast();
            $data['charts'] = $this->stations_model->charts($today_data, $all_stations, $station_id);

            $this->load->view('templates/header', $data);
            $this->load->view('station');
            $this->load->view('templates/footer');
            
        } elseif (isset($_GET['location'])) {
            redirect(base_url('stations/all-stations?search=' . $_GET['location']));
        } else {
            redirect(base_url('stations/all-stations'));
        }
    }

    public function about() {
        
        // Page title and breadcrumb
        $data['page_title'] = ucwords(str_replace('_', ' ', __FUNCTION__));
        $this->breadcrumbs->push($data['page_title'], str_replace('_', '-',__FUNCTION__));
        
        $this->load->view('templates/header', $data);
        $this->load->view('about');
        $this->load->view('templates/footer');
    }
    
    public function help() {
        
        // Page title and breadcrumb
        $data['page_title'] = ucwords(str_replace('_', ' ', __FUNCTION__));
        $this->breadcrumbs->push($data['page_title'], str_replace('_', '-',__FUNCTION__));
        
        $this->load->view('templates/header', $data);
        $this->load->view('help');
        $this->load->view('templates/footer');
    }
    
    public function components() {
        
        // Page title and breadcrumb
        $data['page_title'] = ucwords(str_replace('_', ' ', __FUNCTION__));
        $this->breadcrumbs->push($data['page_title'], str_replace('_', '-',__FUNCTION__));
        
        $this->load->view('templates/header', $data);
        $this->load->view('components');
        $this->load->view('templates/footer');
    }
}
