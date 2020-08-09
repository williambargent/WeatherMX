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

if ($page_title == 'All Stations'){ ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin/>
    <script type="text/javascript" src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin></script>
<?php } ?>

<div class="all-stations <?php if ($page_title == 'All Stations'){ echo 'all'; } else { echo 'index'; } ?>" id="station-filter">
    <div class="row">
         <div class="col">
             <div class="filter-control jplist-panel">
                 <div class="accordion" id="filter-control">
                     <div class="card">
                         <div class="card-header" id="filter-control-header">
                             <h2 class="mb-0">
                                 <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                     Filter Stations <i class="fas fa-caret-down"></i>
                                 </button>
                             </h2>
                         </div> <!-- card-header END -->
                         <div id="filter-control-target" class="collapse" aria-labelledby="filter-control-header" data-parent="#filter-control">
                             <div class="card-body">
                                 <form class="station-filter inline">
                                     <div class="form-group" id="inputOffline">
                                         <label for="inputSearch">Search Stations:</label>
                                         <input class="form-control" id="inputSearch" data-jplist-control="textbox-filter" data-group="station-list" data-path=".search" type="text" placeholder=" Search" 
                                             <?php if (isset($_GET['search'])) { echo 'value="' . $_GET['search'] . '"'; } ?> data-clear-btn-id="name-clear-btn"
                                         />
                                     </div> <!-- form-group END -->
                                     <div class="form-group" id="inputSort">
                                         <label for="inputSort">Sort:</label>
                                         <select class="form-control" id="inputSort" data-jplist-control="select-sort" data-group="station-list" data-name="name" data-id="sort">
                                             <option value="0" data-path="default" selected>Featured Stations</option>
                                             <option value="1" data-path=".name" data-order="asc" data-type="text">Station Name - A-Z</option>
                                             <option value="2" data-path=".name" data-order="desc" data-type="text">Station Name - Z-A</option>
                                             <option value="3" data-path=".owner" data-order="asc" data-type="text">Owner - A-Z</option>
                                             <option value="4" data-path=".owner" data-order="desc" data-type="text">Owner - Z-A</option>
                                             <option value="5" data-path=".distance" data-order="asc" data-type="text" disabled>Distance</option>
                                         </select>
                                     </div> <!-- form-group END -->
                                     <div class="form-group" id="inputDisplay">
                                         <label>Display:</label>
                                         <ul class="checkbox-buttons">
                                             <li>
                                                 <input id="offline" type="checkbox" data-jplist-control="checkbox-path-filter" data-path=".online" data-group="station-list" name="online" data-id="online">
                                                 <label for="offline">Hide Offline Stations</label>
                                             </li>
                                             <li>
                                                 <input id="partial" type="checkbox" data-jplist-control="checkbox-path-filter" data-path=".full" data-group="station-list" name="full" data-id="full">
                                                 <label for="partial">Hide Partial Stations</label>
                                             </li>
                                         </ul>
                                     </div> <!-- form-group END -->
                                 </form>
                             </div> <!-- card-body END -->
                         </div> <!-- filter-controll-target END -->
                     </div> <!-- card END -->
                 </div> <!-- accordian END -->
             </div> <!-- END filter-control -->
             <div class="jplist station-list" data-jplist-group="station-list">                
                 <?php foreach ($all_stations as $station) { 
                      if(time() - strtotime($last_reported[$station['url']][0]['LogDateTime']) <= 3600){
                           $station_status = 'online';
                      } else {
                           $station_status = 'offline';
                      }
                      if (strpos($station['sensors'], 'T') !== FALSE && strpos($station['sensors'], 'W') !== FALSE && strpos($station['sensors'], 'R') !== FALSE ) {
                           $station_sensors = 'full';
                      } else {
                           $station_sensors = 'partial';
                      }
                 ?>
                  <a href="<?= base_url('stations?location='.$station['url']); ?>" class="card-link" data-jplist-item>
                      <div class="card mb-3 <?php if($station % 4 == 0){echo fadein; } ?> <?= $station_status . ' ' . $station_sensors ?>">
                           <div class="row no-gutters">
                               <div class="col-md-3">
                                   <div class="map" id="stationMap<?= $station['url']; ?>"></div>
                               </div> <!-- END col-md-3 -->
                               <div class="col">
                                   <div class="card-body">
                                        <div class="featured">
                                            <?php if (strpos($station['sensors'], 'F') !== FALSE ) { ?>
                                                 <span class="search badge badge-primary">Featured</span>
                                            <?php } if ($station_status == 'offline') { ?>
                                                 <span class="badge badge-offline">Offline</span>
                                            <?php } ?>
                                        </div>
                                        <h3 class="search name"><?= $station['name']; ?></h3>
                                        <ul class="list-unstyled">
                                            <li class="search owner"><span class="font-weight-bold">Owner:</span> <?= $station['owner']; ?></li>
                                            <li class="search model"><span class="font-weight-bold">Model:</span> <?= $station['hardware']; ?></li>
                                            <li class="distance hide">00.00</li>
                                            <li class="search status hide"><?= $station_status ?></li>
                                        </ul>
                                        <div class="info">
                                            <span class="search badge badge-info"><?= $station['latitude']; ?>, <?= $station['longitude']; ?></span>
                                            <span class="badge badge-info"><?= $station['elevation']; ?>m</span>
                                            <span class="search badge badge-info"><?= $station['timezone']; ?></span>
                                        </div> <!-- END info -->
                                   </div> <!-- END card-body -->
                                   <div class="card-footer text-muted">
                                       <div class="row">
                                           <div class="col reported">
                                                <i class="far fa-clock"></i>
                                                <p class="d-inline"> Reported <span class="time-ago" title="<?= $last_reported[$station['url']][0]['LogDateTime']; ?>"></span>.</p>
                                           </div>
                                           <div class="col-sm-4 sensors">
                                                <p class="d-inline">Sensors: </p>
                                                <?php if (strpos($station['sensors'], 'T') !== FALSE) { ?>
                                                     <i class="fas fa-thermometer-three-quarters d-inline"></i>
                                                <?php } if (strpos($station['sensors'], 'W') !== FALSE) { ?>
                                                    <i class="fas fa-wind d-inline"></i>
                                                <?php } if (strpos($station['sensors'], 'R') !== FALSE) { ?>
                                                     <i class="fas fa-tint d-inline"></i>
                                                <?php } if (strpos($station['sensors'], 'U') !== FALSE) { ?>
                                                     <i class="fas fa-sun d-inline"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                           </div>
                           <div class="overlay"></div>
                      </div>
                      <script type="text/javascript">
                           var stationMap<?= $station['url']; ?> = L.map('stationMap<?= $station['url']; ?>').setView([<?= $station['latitude']; ?>, <?= $station['longitude']; ?>], 13);
                           L.marker([<?= $station['latitude']; ?>, <?= $station['longitude']; ?>],{icon: L.divIcon({
                               html: '<i class="fas fa-map-marker-alt fa-3x"></i>',
                               iconAnchor: [12, 36],
                               className: 'map-pointer'})
                           }).addTo(stationMap<?= $station['url']; ?>);
                           L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                               maxZoom: 15,
                               minZoom: 5,
                               id: 'mapbox.streets',
                               accessToken: 'pk.eyJ1Ijoid2lsbGlhbWJhcmdlbnQiLCJhIjoiY2p5aGphNnBmMDA4bDNibzlxZXo1Z2pzaCJ9.fzFtOlKOaUrGGgTaOgmhuA'
                           }).addTo(stationMap<?= $station['url']; ?>);
                      </script>
                  </a>
             <?php } ?>
             </div>
             <div class="card" data-jplist-control="no-results" data-group="station-list" data-name="no-results">
                  <div class="card-body">
                      <p>No Results Found</p>
                  </div>
             </div>
             <div data-jplist-control="pagination" data-group="station-list"  data-items-per-page="10" data-current-page="0" data-name="pagination" data-selected-class="active" data-disabled-class="disabled">
                 <div class="row">
                     <div class="col-sm">
                         <span data-type="info">
                             <span class="font-weight-bold">Displaying:</span> {startItem} - {endItem} <br>
                             <span class="font-weight-bold">Total Stations:</span> {itemsNumber} <br>
                             <span class="font-weight-bold">Pages: </span> {pageNumber} of {pagesNumber}
                          </span>
                      </div>
                      <div class="col-sm">
                           <nav aria-label="navigation">
                               <ul class="pagination justify-content-end">
                                    <li class="page-item" data-type="prev"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item jplist-holder" data-type="pages"><a class="page-link" data-type="page">{pageNumber}</a></li>
                                    <li class="page-item" data-type="next"><a class="page-link" href="#">Next</a></li>
                               </ul>
                           </nav>
                       </div>
                  </div>
             </div>
         </div> <!-- col-md-3 END -->
     </div> <!-- row END -->
</div> <!-- END all-stations -->
<script src="https://www.jplist.org/js/1.2.0/jplist.min.js"></script>
<script src="<?= base_url('assets/js/cached/suggest.js'); ?>"></script>
<script type="text/javascript">
    
    jplist.init({
        storage: 'sessionStorage',
        storageName: 'jplist'
    });

    var words = ["Blean", "Canterbury", "Tankerton", "Chatham"];
    $('.filter-control #inputSearch').suggest(words);

</script>