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
        $data['page_title'] = 'William Bargent';

        return view('templates/header', $data)
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
