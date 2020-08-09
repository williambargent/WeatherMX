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
?>

<div class="components">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="card-body">
                            <h1>Header 1</h1>
                            <h2>Header 2</h2>
                            <h3>Header 3</h3>
                            <h4>Header 4</h4>
                            <h5>Header 5</h5>
                            <h6>Header 6</h6>
                            <p>Paragraph</p>
                            <a href="<?= base_url('components'); ?>">Hyperlink</a>

                            <p class="font-weight-bold">Bold text.</p>
                            <p class="font-weight-light">Light weight text.</p>
                            <p class="font-italic">Italic text.</p>

                            <p class="text-left">Left aligned text.</p>
                            <p class="text-center">Centre aligned text.</p>
                            <p class="text-right">Right aligned text.</p>

                            <p>Primary Badge <span class="badge badge-primary">Featured</span></p>
                            <p>Secondary Badge <span class="badge badge-secondary">New</span></p>
                            <p>Light Badge <span class="badge badge-light">New</span></p>
                            <p>Dark Badge <span class="badge badge-dark">New</span></p>
                            <p>Offline Badge <span class="badge badge-offline">Offline</span></p>
                            <p>Info Badge <span class="badge badge-info">Display's information</span></p>
                        </div> <!-- END card-body -->
                    </div> <!-- END col -->
                </div> <!-- END row -->
            </div> <!-- END card -->
        </div> <!-- END col-md-3 -->
    </div> <!-- END row -->
</div> <!-- END components -->