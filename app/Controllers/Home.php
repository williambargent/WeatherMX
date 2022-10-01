<?php
/**
 * WeatherMX - WeatherMX - an elegant, free, open-source web application built to display data form CumulusMX; the USB weather stations data logger.
 * https://github.com/williambargent/WeatherMX
 *
 * @author William Bargent code@williambargent.co.uk
 * 
 * @copyright Copyright (c) 2022, William Bargent
 * @license AGPL-3.0 - https://github.com/williambargent/WeatherMX/blob/main/LICENSE_WEATHERMX
 *
 **/

namespace App\Controllers;

class Home extends BaseController {

    public function index() {
        // Page title
        $data['page_title'] = 'Home - William Bargent';
        
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT * FROM stations');
        $data['stationsAll'] = $query->getResult();
        
        foreach ($data['stationsAll'] as $station) {
            
            $db2 = \Config\Database::connect('cumlusmx');
            $query2   = $db2->query("SELECT LogDateTime FROM " . $station->table_realtime . " ORDER BY LogDateTime DESC LIMIT 1");
            $timeSince = $query2->getResult();
            $timeSince = time() - strtotime($timeSince[0]->LogDateTime);
            $data['lastReported'][$station->url] = $timeSince;
        }

        return view('templates/header', $data)
             . view('all_stations', $data)
             . view('templates/footer');
    }
    public function allStations() {
        // Page title
        $data['page_title'] = 'All Stations - William Bargent';
        
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT * FROM stations');
        $data['stationsAll'] = $query->getResult();
        
        foreach ($data['stationsAll'] as $station) {
            
            $db2 = \Config\Database::connect('cumlusmx');
            $query2   = $db2->query("SELECT LogDateTime FROM " . $station->table_realtime . " ORDER BY LogDateTime DESC LIMIT 1");
            $timeSince = $query2->getResult();
            $timeSince = time() - strtotime($timeSince[0]->LogDateTime);
            $data['lastReported'][$station->url] = $timeSince;
        }

        return view('templates/header', $data)
             . view('all_stations', $data)
             . view('templates/footer');
    }
    public function about() {
        // Page title
        $data['page_title'] = 'About - William Bargent';

        return view('templates/header', $data)
             . view('about')
             . view('templates/footer');
    }
    public function help() {
        // Page title
        $data['page_title'] = 'Help - William Bargent';

        return view('templates/header', $data)
             . view('help')
             . view('templates/footer');
    }
}
