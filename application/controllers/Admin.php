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
class Admin extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect(base_url('all-stations'));
    }
}