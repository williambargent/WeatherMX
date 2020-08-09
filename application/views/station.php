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

// Date for HighChart
$datetime = explode(" ", date("Y-m-d H:i:s"));
$date = explode("-", $datetime[0]);
$recorddate = $date[0] . ', ' . $date[1] . ', ' . $date[2];

// Station offline
if (time() - strtotime($realtime_data[0]['LogDateTime']) <= 3600) {
    $station_status = 'online';
} else {
    $station_status = 'offline';
}

// Compass rotate direction
if ($realtime_data[0]['bearing'] <= 180) {
    $compass_rotate = $realtime_data[0]['bearing'];
} else {
    $rotate = 360 - $realtime_data[0]['bearing'];
    $compass_rotate = '-' . $rotate;
}
?>

<div class="station">
    <br>
    <h3>
    <?php 
        echo $all_stations[$station_id]['name'].' Station';
        if ($station_status == 'offline') { ?>
        <span class="offline">(Offline)</span>
        <?php } ?>
    
    </h3>
    <p><i class="far fa-clock"></i> Reported <span class="time-ago" title="<?= $realtime_data[0]['LogDateTime'] ?>"></span>.</p>
    <div class="widgets">
        <div class="row">
            <div class="col col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                Temperature
                            </button>
                        </h2>
                    </div> <!-- card-header END -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="thermometer-container">
                                    <div class="thermometer">
                                        <div class="track">
                                            <div class="goal">
                                                <div class="amount" id="goalAmount"><?= $realtime_data[0]['temp'] ?></div> <!-- END amount -->
                                            </div> <!-- END goal -->
                                            <div class="markers">
                                                <div class="amount" id="markers">60</div>
                                                <div class="amount" id="markers">40</div>
                                                <div class="amount" id="markers">20</div>
                                                <div class="amount" id="markers">0</div>
                                                <div class="amount" id="markers">-20</div>
                                            </div> <!-- END markers -->
                                            <div class="progress">
                                                <div style="display: block;" class="amount" id="progessAmount">27</div> <!-- END amount -->
                                            </div> <!-- END progress -->
                                            <div class="bulb">
                                                <div class="inner-bulb"></div> <!-- END inner-bulb -->
                                            </div> <!-- END bulb -->
                                        </div> <!-- END track -->
                                    </div> <!-- END thermometer -->
                                </div>
                            </div>
                            <div class="col">
                                <ul class="list-unstyled"/>
                                    <li><b>Temperature:</b> <?= $realtime_data[0]['temp'] ?> &deg;C</li>
                                    <li><b>Humidity:</b> <?= $realtime_data[0]['hum'] ?>%</li>
                                    <li><b>Pressure:</b> <?= $realtime_data[0]['press'] ?> mb</li>
                            </ul>
                            </div>
                        </div>
                    </div> <!-- END card-body -->
                </div> <!-- END card -->
            </div> <!-- END col-md-4 -->
            <div class="col-auto">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                Wind
                            </button>
                        </h2>
                    </div> <!-- card-header END -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="compass-container">
                                    <div class="bearing-text">
                                        <h2 id="clear"><?= $realtime_data[0]['currentwdir'] ?></h2>
                                        <h4 id="clear"><?= $realtime_data[0]['wgust'] ?> <span>MPH</span></h4>
                                    </div> <!-- END bearing-text -->
                                    <div class="compass-dial">
                                        <div class="compass-dial-pointer">
                                        </div> <!-- END compass-pointer -->
                                    </div> <!-- END compass-dial -->
                                </div> <!-- END compass-container -->
                            </div>
                            <div class="col-auto">
                                <ul class="list-unstyled">
                                    <li><b>Wind Gust:</b> <?= $realtime_data[0]['wspeed'] ?></li>
                                    <li><b>Bearing:</b> <?= $realtime_data[0]['bearing'] ?>&deg; (<?= $realtime_data[0]['currentwdir'] ?>)</li>
                                    <li><b>Beaufort:</b> <?= $realtime_data[0]['beaufortnumber'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END card-body -->
                </div> <!-- END card -->
            </div> <!-- END col-md-5 -->
            <div class="col-auto">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                Rain
                            </button>
                        </h2>
                    </div> <!-- card-header END -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="rain-container">
                                    <div class="raingauge">
                                        <div class="track">
                                            <div class="goal">
                                                <div class="amount" id="goalAmount"></div> <!-- END amount -->
                                            </div> <!-- END goal -->
                                            <div class="markers">
                                                <div class="amount" id="markers">60</div>
                                                <div class="amount" id="markers">45</div>
                                                <div class="amount" id="markers">30</div>
                                                <div class="amount" id="markers">15</div>
                                            </div> <!-- END markers -->
                                            <div class="progress"">
                                                <div style="display: block;" class="amount" id="progessAmount"><?= $realtime_data[0]['rfall'] ?></div> <!-- END amount -->
                                            </div> <!-- END progress -->
                                        </div> <!-- END track -->
                                    </div> <!-- END raingauge -->
                                </div>
                            </div>
                            <div class="col-auto"><ul class="list-unstyled"/>
                                    <li><b>Last Hour:</b> <?= $realtime_data[0]['rfall'] ?> mm</li>
                                    <li><b>Total Rain:</b> <?= $realtime_data[0]['rfall'] ?> mm</li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END card-body -->
                </div> <!-- END card -->
            </div> <!-- END col-md-4 -->
            <div class="col-auto">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                <a href="https://darksky.net/poweredby/">Powered by Dark Sky</a>
                            </button>
                        </h2>
                    </div> <!-- card-header END -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <ul class="list-unstyled">
                                    <li><b>Dewpoint:</b> <?= $dark_sky_forcast['currently']['dewPoint'] ?> &deg;F</li>
                                    <li><b>Visibility:</b> <?= round($dark_sky_forcast['currently']['visibility']) ?> miles</li>
                                    <li><b>Cloud Cover:</b> <?= $dark_sky_forcast['currently']['cloudCover'] * 100 ?>%</li>
                                    <li><b>Precipitation:</b> <?= $dark_sky_forcast['currently']['precipIntensity'] ?></li>
                                    <li><b>Ozone:</b> <?= $dark_sky_forcast['currently']['ozone'] ?> DU</li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <ul class="list-unstyled">
                                    <li><b>Sunrise:</b> <?= date('g:i A', $dark_sky_forcast['daily']['data'][0]['sunriseTime']) ?></li>
                                    <li><b>Sunset:</b> <?= date('g:i A', $dark_sky_forcast['daily']['data'][0]['sunsetTime']) ?></li>
                                    <li><b>UV Index:</b> <?= $dark_sky_forcast['currently']['uvIndex'] ?></li>
                                </ul>
                                <div class="uv-container">
                                    <div class="pyramid-container">
                                        <div class="pyramid level-10 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 11) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-9 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 10) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-8 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 9) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-7 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 8) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-6 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 7) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-5 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-4 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 5) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-3 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 4) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-2 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 3) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-1 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 2) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                        <div class="pyramid level-0 <?php if ($dark_sky_forcast['currently']['uvIndex'] >= 1) { if ($dark_sky_forcast['currently']['uvIndex'] >= 6) { echo 'pyramid-red'; } elseif ($dark_sky_forcast['currently']['uvIndex'] >= 3) { echo 'pyramid-green'; } else { echo 'pyramid-blue'; }}?>"></div>
                                    </div>
                                </div> <!-- END uv-container -->
                            </div>
                            <div class="col-auto">
                                <ul class="list-unstyled">
                                    <li><b>Moon Phase:</b> <?= $dark_sky_forcast['daily']['data'][0]['moonPhase'] ?></li>
                                    <div class="moon-container">
                                        <div class="moon">
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END card-body -->
                </div> <!-- END card -->
            </div> <!-- END col-md-6 -->
            
            <div class="col-auto">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                <a href="https://darksky.net/poweredby/">Powered by Dark Sky</a>
                            </button>
                        </h2>
                    </div> <!-- card-header END -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <i class="fas fa-calendar-day"></i>
                                <p>Today</p>
                                <ul class="list-unstyled">
                                    <li><b>High:</b> <?= $dark_sky_forcast['daily']['data'][0]['temperatureMax'] ?> &deg;F</li>
                                    <li><b>Low:</b> <?= $dark_sky_forcast['daily']['data'][0]['temperatureMin'] ?> &deg;F</li>
                                    <li><b>Wind:</b> <?= round($dark_sky_forcast['daily']['data'][0]['windGust']) ?> MPH</li>
                                    <li><b>Rain:</b> <?= round($dark_sky_forcast['daily']['data'][0]['precipIntensityMax']) ?> IN</li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day"></i>
                                <p>Tomorrow</p>
                                <ul class="list-unstyled">
                                    <li><b>High:</b> </li>
                                    <li><b>Low:</b> </li>
                                    <li><b>Wind:</b> </li>
                                    <li><b>Rain:</b> </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day"></i>
                                <p>Monday</p>
                                <ul class="list-unstyled">
                                    <li><b>High:</b> </li>
                                    <li><b>Low:</b> </li>
                                    <li><b>Wind:</b> </li>
                                    <li><b>Rain:</b> </li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END card-body -->
                </div> <!-- END card -->
            </div> <!-- END col-md-6 -->
        </div> <!-- END row -->
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="mb-0">
                        <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                            About Stations <i class="fas fa-caret-down"></i>
                        </button>
                    </h2>
                </div> <!-- card-header END -->
                <div class="card-body">
                    <div class="featured">
                           <?php 
                           if (strpos($all_stations[$station_id]['sensors'], 'F') !== FALSE ) { ?>
                               <span class="search badge badge-primary">Featured</span>
                           <?php } if ($station_status == 'offline') { ?>
                                <span class="badge badge-offline">Offline</span>
                           <?php } ?>
                    </div>
                    <div class="map float-right" id="stationMap1"></div>
                    <h4><?= $all_stations[$station_id]['name'] ?> Station</h4>
                    <ul class="list-unstyled">
                        <li class="search owner"><span class="font-weight-bold">Owner:</span> <?= $all_stations[$station_id]['owner']; ?></li>
                        <li class="search model"><span class="font-weight-bold">Model:</span> <?= $all_stations[$station_id]['hardware']; ?></li>
                    </ul>
                    <div class="info">
                        <span class="search badge badge-info"><?= $all_stations[$station_id]['latitude']; ?>, <?= $all_stations[$station_id]['longitude']; ?></span>
                        <span class="badge badge-info"><?= $all_stations[$station_id]['elevation']; ?>m</span>
                        <span class="search badge badge-info"><?= $all_stations[$station_id]['timezone']; ?></span>
                    </div>
                    <br>
                    <h5>Summery:</h5
                    <p>This is my personal weather station (PWS); a <a href="https://shop.netatmo.com/gbp_en/weatherstation.html">Netatmo Full Smart Station</a>. All data is then uploaded to <a href="https://www.netatmo.com">Netatmo's</a> smart home platform where a <a href="https://github.com/williambargent/Netatmo-Weather-MySQL">script I wrote</a> utilizes the API to pull data and store it in the <a href="https://cumuluswiki.wxforum.net/a/Cumulus_MX">CumulusMX</a> database hosted by <a href="https://mariadb.com">MariaDB</a> in <a href="https://ubuntu.com/">Ubuntu</a> <a href="https://help.ubuntu.com/lts/serverguide/lxc.html">LXC</a> on one of my <a href="https://www.proxmox.com/en/proxmox-ve">Proxmox VE</a> hosts.</p>
                    <p>My weather station was installed in July 2019 and consists of an <a href="https://www.netatmo.com/en-gb/weather/weatherstation">outdoor temperature and humidity sensor</a> housed inside a Stevenson screen on a North facing wall 1.4 meters off the ground, an <a href="https://www.netatmo.com/en-gb/weather/weatherstation/accessories#windgauge">anemometer</a> secured to a 2 meter long pole on a 7 meter high flat roof and a <a href="https://www.netatmo.com/en-gb/weather/weatherstation/accessories#raingauge">rain gauge</a> in a clear open part of the garden mounted to a wooden fence post. 
                    <p>All locations were chosen to provide the most accurate readings.</p>
                    <h5>History:</h5>
                    <ol>
                        <li>Installation - July 2019</li>
                        <li>Anemometer replacement - August 2019</li>
                    </ol>
                </div> <!-- END card-body -->
            </div> <!-- END card -->
        </div> <!-- END col -->
    </div> <!-- END row -->
    <?php if ($station_status == 'online') { ?>
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                Station Graphs <i class="fas fa-caret-down"></i>
                            </button>
                        </h2>
                    </div> <!-- card-header END -->
                    <div class="card-body">
                        <?php if (strpos($all_stations[$station_id]['sensors'], 'T') !== FALSE) { ?>
                            <h4>Temperature</h4>
                            <span class="badge badge-light">Temperature</span>
                            <span class="badge badge-dark">Dewpoint</span>
                            <br><br>
                            <div class="chart" id="chart-temp"></div>
                            <br><br>
                            <h4>Humidity</h4>
                            <span class="badge badge-light">Humidity</span>
                            <br><br>
                            <div class="chart"  id="chart-humidity"></div>
                            <br><br>
                            <h4>Pressure</h4>
                            <span class="badge badge-light">Pressure</span>
                            <br><br>
                            <div class="chart"  id="chart-pressure"></div>
                        <?php } if (strpos($all_stations[$station_id]['sensors'], 'W') !== FALSE) { ?>
                            <br><br>
                            <h4>Wind</h4>
                            <span class="badge badge-light">Wind Speed</span>
                            <span class="badge badge-dark">Wind Gust</span>
                            <br><br>
                            <div class="chart"  id="chart-wind"></div>
                            <br><br>
                            <h4>Wind Direction</h4>
                            <span class="badge badge-light">Wind Direction</span>
                            <br><br>
                            <div class="chart"  id="chart-winddirection"></div>
                        <?php } if (strpos($all_stations[$station_id]['sensors'], 'R') !== FALSE) { ?>
                            <br><br>
                            <h4>Rain</h4>
                            <span class="badge badge-light">Rain Rate</span>
                            <span class="badge badge-dark">Rain Total</span>
                            <br><br>
                            <div class="chart"  id="chart-rain"></div>
                        <?php } if (strpos($all_stations[$station_id]['sensors'], 'U') !== FALSE) { ?>
                            <br><br>
                            <h4>UV Index</h4>
                            <span class="badge badge-light">UV Index</span>
                            <br><br>
                            <div class="chart"  id="chart-uv"></div>
                        <?php } ?>
                    </div> <!-- END card-body -->
                </div> <!-- END card -->
            </div> <!-- END col -->
        </div> <!-- END row -->
    <?php }
    if ($station_status == 'offline') { ?>
        <div class="overlay"></div>
    <?php } ?>
</div> <!-- END components -->

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin/>
<script type="text/javascript" src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var compass_rotate = '<?= $compass_rotate ?>';
    
     var stationMap1 = L.map('stationMap1').setView([51.362937, 1.052926], 13);
     L.marker([51.362937, 1.052926],{icon: L.divIcon({
         html: '<i class="fas fa-map-marker-alt fa-3x"></i>',
         iconAnchor: [12, 36],
         className: 'map-pointer'})
     }).addTo(stationMap1);
     L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
         maxZoom: 15,
         minZoom: 5,
         id: 'mapbox.streets',
         accessToken: 'pk.eyJ1Ijoid2lsbGlhbWJhcmdlbnQiLCJhIjoiY2p5aGphNnBmMDA4bDNibzlxZXo1Z2pzaCJ9.fzFtOlKOaUrGGgTaOgmhuA'
     }).addTo(stationMap1);
       
    new Highcharts.chart('chart-temp', {
        title: {
            text: '',
        },
        chart: {
            type: 'line',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidthPlus: 0,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + String.fromCharCode(176) + 'C';
            },
        },
        series: [{
            name: 'Dewpoint',
            color: '#1565C0',
            data: [<?= $charts['dewpoint'] ?>],
        }, {
            name: 'Temperature',
            color: '#1E88E5',
            data: [<?= $charts['temperature'] ?>]
        }],
    });
    
    new Highcharts.chart('chart-humidity', {
        title: {
            text: '',
        },
        chart: {
            type: 'line',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidthPlus: 0,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + '%';
            },
        },
        series: [{
            name: 'Humidity',
            color: '#1E88E5',
            data: [<?= $charts['humidity'] ?>]
        }],
    });
    
    new Highcharts.chart('chart-pressure', {
        title: {
            text: '',
        },
        chart: {
            type: 'line',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidthPlus: 0,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + 'mb';
            },
        },
        series: [{
            name: 'Pressure',
            color: '#1E88E5',
            data: [<?= $charts['pressure'] ?>]
        }],
    });
    
    new Highcharts.chart('chart-wind', {
        title: {
            text: '',
        },
        chart: {
            type: 'line',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidthPlus: 0,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + 'MPH';
            },
        },
        series: [{
            name: 'Wind Gust',
            color: '#1565C0',
            data: [<?= $charts['wind_gust'] ?>]
        }, {
            name: 'Wind Speed',
            color: '#1E88E5',
            data: [<?= $charts['wind_speed'] ?>]
        }],
    });
    
    new Highcharts.chart('chart-winddirection', {
        title: {
            text: '',
        },
        chart: {
            type: 'scatter',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            max: 360,
            min: 0,
            tickInterval: 90,
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                states: {
                    hover: {
                        enabled: false,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + String.fromCharCode(176);
            },
        },
        series: [{
            name: 'Wind Direction',
            color: '#1E88E5',
            data: [<?= $charts['wind_direction'] ?>]
        }],
    });
    
    new Highcharts.chart('chart-rain', {
        title: {
            text: '',
        },
        chart: {
            type: 'line',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidthPlus: 0,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + 'MM';
            },
        },
        series: [{
            name: 'Rain Total',
            color: '#1565C0',
            data: [<?= $charts['rain_total'] ?>]
        }, {
            name: 'Rain Rate',
            color: '#1E88E5',
            data: [<?= $charts['rain_rate'] ?>]
        }],
    });
    
    new Highcharts.chart('chart-uv', {
        title: {
            text: '',
        },
        chart: {
            type: 'line',
            style: {
                fontFamily: '"Montserrat", sans-serif',
                color: "#454545"
            },
        },
        xAxis: {
            type: 'datetime',
            lineColor: '#ddd',
            tickColor: '#ddd',
            gridLineColor: '#ddd',
            dateTimeLabelFormats: { // don't display the dummy year
                hour: '%I %p',
                minute: '%I:%M %p',
            },
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
            min: Date.UTC(<?= $recorddate ?>, 0, 0),
            max: Date.UTC(<?= $recorddate ?>, 24, 0),
        },
        yAxis: {
            title: {
                text: '',
            },
            labels: {
                style: {
                   color: '#454545',
                },
             },
        },
        plotOptions: {
            series: {
                showInLegend: false,
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidthPlus: 0,
                    },
                },
            },
            line: {
                marker: false,
            },
        },
        tooltip: {
            shadow: false,
            borderRadius: 0,
            backgroundColor: '#FFF',
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%I:%M %p', new Date(this.x)) + ', Value: ' + this.y + String.fromCharCode(176) + 'C';
            },
        },
        series: [{
            name: 'UV Index',
            color: '#1E88E5',
            data: [<?= $charts['uv'] ?>]
        }],
    });
</script>