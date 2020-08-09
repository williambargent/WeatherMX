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
                
                  </div> <!-- END fluid-container -->
            </main>
            <footer class="page-footer">
                <div class="footer">
                    <div class="fluid-container">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="footer-brand" href="<?= base_url(); ?>">
                                    <i class="fas fa-thermometer-three-quarters fa-lg"></i>
                                    <span class="font-weight-bold">W</span>eather<span class="font-weight-bold">MX</span>
                                </a>
                                <p>- an elegant, free, open-source web application built to display data from CumulusMX; the weather stations data logger.</p>
                                <a href="https://github.com/williambargent/WeatherMX">
                                    <span class="search badge badge-white">View GitHub Project</span>
                                </a>
                            </div> <!-- END col-lg-6 -->
                            <div class="col-md text-center">
                            </div> <!-- END col-md -->
                            <div class="col-md text-center">
                            </div> <!-- END col-md -->
                        </div> <!-- END row -->
                    </div> <!-- END fluid-container -->
                </div> <!-- END footer -->
                <div class="navbar disclamer">
                    <div class="fluid-container">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link" href="https://github.com/williambargent/WeatherMX/blob/master/LICENSE"> GNU Affero General Public License v3.0</a>
                            </li>
                        </ul>
                    </div> <!-- END fluid-container -->
                </div> <!-- END disclamer -->

                <!-- Javascript -->
                <script type="text/javascript" src="<?= base_url('assets/js/main.js'); ?>"></script>
                <script type="text/javascript" src="https://www.googletagmanager.com/gtag/js?id=UA-119425120-1" async></script>
                <script>
                    // Google Analytics
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());

                    gtag('config', 'UA-119425120-1');
                </script>
            </footer>            
        </div> <!-- END page-wrapper -->
    </body>
</html>