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
                
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin/>
<script type="text/javascript" src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin></script>

<div class="map" id="stationMap"></div>
<div class="jumbotron text-center">
    <h1 class="display-4"><span class="font-weight-bold">W</span>eather<span class="font-weight-bold">MX</span></h1>
    <p>- an elegant, free, open-source web application built to display data from CumulusMX; the weather stations data logger.</p>
</div>
<div class="fluid-container">
<script type="text/javascript">
                               //var stationMap = L.map('stationMap').setView([51.346566, 0.891603], 13);
                               var stationMap = L.map('stationMap').setView([51.303651, 1.044560], 13);
                                L.marker([51.303651, 1.044560],{icon: L.divIcon({
                                    html: '<i class="fas fa-map-marker-alt fa-3x"></i>',
                                    iconAnchor: [12, 36],
                                    className: 'map-pointer'})
                                }).addTo(stationMap);
                                L.marker([51.362937, 1.052926],{icon: L.divIcon({
                                    html: '<i class="fas fa-map-marker-alt fa-3x"></i>',
                                    iconAnchor: [12, 36],
                                    className: 'map-pointer'})
                                }).addTo(stationMap);
                                L.marker([51.298695, 1.070204],{icon: L.divIcon({
                                    html: '<i class="fas fa-map-marker-alt fa-3x"></i>',
                                    iconAnchor: [12, 36],
                                    className: 'map-pointer'})
                                }).addTo(stationMap);
                                L.marker([51.398504, 0.539541],{icon: L.divIcon({
                                    html: '<i class="fas fa-map-marker-alt fa-3x"></i>',
                                    iconAnchor: [12, 36],
                                    className: 'map-pointer'})
                                }).addTo(stationMap);
                                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                                    maxZoom: 10,
                                    id: 'mapbox.streets',
                                    accessToken: 'pk.eyJ1Ijoid2lsbGlhbWJhcmdlbnQiLCJhIjoiY2p5aGphNnBmMDA4bDNibzlxZXo1Z2pzaCJ9.fzFtOlKOaUrGGgTaOgmhuA'
                                   }).addTo(stationMap);
</script>