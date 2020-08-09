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
 **/

class Stations_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function all_stations() {
        
        $this->db->select('url, name, owner, hardware, timezone, latitude, longitude, elevation, sensors, table_realtime, table_monthly');
        $query = $this->db->get('stations');
        return $query->result_array();
    }
    
    public function stations_lastreported($all_stations) {
        
        //Create array with last reported date
        foreach ($all_stations as $value) {
        
            $db_cumlusmx = $this->load->database('cumlusmx', TRUE);
            $query = $db_cumlusmx->query("SELECT LogDateTime FROM " . $value['table_realtime'] . " ORDER BY LogDateTime DESC LIMIT 1");
            $result = $query->result_array();
            
            $results[$value['url']] = $result;
        }
        
        return $results;
    }
    
    public function table_realtime($table_realtime) {

        $db_cumlusmx = $this->load->database('cumlusmx', TRUE);
        $query = $db_cumlusmx->query("SELECT * FROM " . $table_realtime . " ORDER BY LogDateTime DESC LIMIT 1");
        $result = $query->result_array();
        return $result;
    }
    
    public function table_monthly($table_monthly) {

        $db_cumlusmx = $this->load->database('cumlusmx', TRUE);
        $query = $db_cumlusmx->query("SELECT * FROM " . $table_monthly . " WHERE DATE(LogDateTime) = CURDATE() ORDER BY LogDateTime");
        $result = $query->result_array();
        return $result;
    }
    
    public function charts($today_data, $all_stations, $station_id) {
        
        $temperature = '';
        $humidity = '';
        $dewpoint = '';
        $wind_speed = '';
        $wind_gust = '';
        $wind_direction = '';
        $rain_rate = '';
        $rain_total = '';
        $pressure = '';
        $uv = '';

        //Temp
        foreach ($today_data as $data) {
            $datetime = explode(" ", $data['LogDateTime']);
            $date = explode("-", $datetime[0]);
            $time = explode(":", $datetime[1]);
            if (strpos($all_stations[$station_id]['sensors'], 'T') !== FALSE) {
                $temperature .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Temp'] . "], ";
                $humidity .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Humidity'] . "], ";
                $dewpoint .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Dewpoint'] . "], ";
                $pressure .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Pressure'] . "], ";
            } if (strpos($all_stations[$station_id]['sensors'], 'W') !== FALSE) {
                $wind_speed .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Windspeed'] . "], ";
                $wind_gust .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Windgust'] . "], ";
                $wind_direction .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['Windbearing'] . "], ";
            } if (strpos($all_stations[$station_id]['sensors'], 'R') !== FALSE) {
                $rain_rate .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['RainRate'] . "], ";
                $rain_total .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['TodayRainSoFar'] . "], ";
                } if (strpos($all_stations[$station_id]['sensors'], 'U') !== FALSE) {
                $uv .= '[Date.UTC(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ', ' . $time[0] . ', ' . $time[1] . '), ' . $data['UVindex'] . "], ";
            }
        }
        
        return array( "temperature" => $temperature,
                      "humidity" => $humidity,
                      "dewpoint" => $dewpoint,
                      "wind_speed" => $wind_speed,
                      "wind_gust" => $wind_gust,
                      "wind_direction" => $wind_direction,
                      "rain_rate" => $rain_rate,
                      "rain_total" => $rain_total,
                      "pressure" => $pressure,
                      "uv" => $uv,
                );
    }
    
    public function dark_sky_forcast() {
        
        $url = 'https://api.darksky.net/forecast/0beb79fcdde2ff403dc4a423b660e8f4/51.303651,1.044560';
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        return json_decode($result, true);
    }
}
