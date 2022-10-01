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
 * */
?>

<!-- Leaflet Map Load -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>          
<!-- jplist-es6 Load -->
<script src="<?= base_url('/assets/jplist-es6-1.2.0/jplist-es6.min.js') ?>"></script>

<div class="all-stations" id="station-filter">
    <div class="row">
        <div class="col">
            <div class="filter-control jplist-panel">
                <div class="accordion" id="filter-control">
                    <div class="card">
                        <div class="card-header" id="filter-control-header">
                            <h2 class="mb-0">
                                <button class="btn btn-link test" type="button" data-toggle="collapse" data-target="#filter-control-target" aria-expanded="true" aria-controls="filter-control-target">
                                    Filter Stations <i class="bi bi-caret-down-fill"></i>
                                </button>
                            </h2>
                        </div> <!-- card-header END -->
                        <div id="filter-control-target" class="collapse" aria-labelledby="filter-control-header" data-parent="#filter-control">
                            <div class="card-body">
                                <form class="station-filter inline">
                                    <div class="form-group" id="inputOffline">
                                        <label for="inputSearch">Search Stations:</label>
                                        <input class="form-control" id="inputSearch" data-jplist-control="textbox-filter" data-group="station-list" data-path=".search" type="text" placeholder=" Search" data-clear-btn-id="name-clear-btn" />
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
                        </div> <!-- filter-control-target END -->
                    </div> <!-- card END -->
                </div> <!-- accordion END -->
            </div> <!-- END filter-control -->
            <div class="jplist station-list" id="jplist" data-jplist-group="station-list">                
                <?php foreach ($stationsAll as $station) { ?>
                <?php
                    // If Featured
                    if (strpos($station->sensors, 'F') !== FALSE) {
                        $stationCard['isFeatured'] = TRUE;
                        $stationCard['featured'] = 'featured';
                    } else {
                        $stationCard['isFeatured'] = FALSE;
                        $stationCard['featured'] = NULL;
                    }
                    // If offline
                    if ($lastReported[$station->url] > $station->offline_timeout) {
                        $stationCard['offline'] = TRUE;
                        $stationCard['status'] = 'offline';
                    } else {
                        $stationCard['offline'] = FALSE;
                        $stationCard['status'] = 'online';
                    }
                    // If full
                    if (strpos($station->sensors, 'TRW') !== FALSE) {
                        $stationCard['partial'] = 'full';
                    } else {
                        $stationCard['partial'] = 'parial';
                    }
                ?>
                    <a href="<?= base_url('stations?location='); ?>" class="card-link" data-jplist-item>
                        <div class="card mb-3 <?= $stationCard['status']; ?> <?= $stationCard['featured']; ?> <= $stationCard['partial']; ?>">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <div class="map" id="map_<?= $station->url; ?>"></div>
                                </div> <!-- END col-md-3 -->
                                <div class="col">
                                    <div class="card-body">
                                        <div class="featured">
                                            <?php if ($stationCard['isFeatured'] === TRUE) { ?>
                                                <span class="search badge badge-primary">Featured</span>
                                            <?php } if ($stationCard['offline'] === TRUE) { ?>
                                                 <span class="badge badge-offline">Offline</span>
                                            <?php } ?>
                                        </div>
                                        <h3 class="search name"><?= $station->name; ?></h3>
                                        <ul class="list-unstyled">
                                            <li class="search owner"><span class="font-weight-bold">Owner:</span> <?= $station->owner; ?></li>
                                            <li class="search model"><span class="font-weight-bold">Model:</span> <?= $station->hardware; ?></li>
                                            <li class="distance hide">00.00</li>
                                            <li class="search status hide"></li>
                                        </ul>
                                        <div class="info">
                                            <span class="search badge badge-info"><?= $station->timezone; ?></span>
                                            <span class="badge badge-info"><?= $station->elevation; ?>m</span>
                                            <span class="search badge badge-info"><?= $station->latitude . " " . $station->longitude; ?></span>
                                        </div> <!-- END info -->
                                    </div> <!-- END card-body -->
                                    <div class="card-footer text-muted">
                                        <div class="row">
                                            <div class="col reported">
                                                <i class="far fa-clock"></i>
                                                <?php
                                                    $timeAgoUnix = $lastReported[$station->url];
                                                    if ($timeAgoUnix < 60) {
                                                        // Less than 1 min
                                                        $timeAgo = $timeAgoUnix . " seconds ago.";
                                                    } elseif ($timeAgoUnix === 60) {
                                                        // Exactly 1 min
                                                        $timeAgo = round($timeAgoUnix / 60) . " minuet ago.";
                                                    } elseif ($timeAgoUnix > 60 && $timeAgoUnix < 3599) {
                                                        // Less than 1 hour
                                                        $timeAgo = round($timeAgoUnix / 60) . " minuets ago.";
                                                    } elseif ($timeAgoUnix === 3600) {
                                                        // Exactly 1 hour
                                                        $timeAgo = round($timeAgoUnix / 3600) . " hour ago.";
                                                    } elseif ($timeAgoUnix > 3600 && $timeAgoUnix < 86399) {
                                                        // Less than 1 day
                                                        $timeAgo = round($timeAgoUnix / 3600) . " hours ago.";
                                                    } elseif ($timeAgoUnix === 86400) {
                                                        // Exactly 1 day
                                                        $timeAgo = round($timeAgoUnix / 86400) . " day ago.";
                                                    } elseif ($timeAgoUnix > 86400 && $timeAgoUnix < 604799) {
                                                        // Less than 1 week
                                                        $timeAgo = round($timeAgoUnix / 86400) . " days ago.";
                                                    } elseif ($timeAgoUnix === 604800) {
                                                        // Exactly 1 week
                                                        $timeAgo = round($timeAgoUnix / 604800) . " week ago.";
                                                    } elseif ($timeAgoUnix > 604800 && $timeAgoUnix < 2627999) {
                                                        // Less than 1 month
                                                        $timeAgo = round($timeAgoUnix / 2628000) . " month ago.";
                                                    } elseif ($timeAgoUnix === 2628000) {
                                                        // Exactly 1 month
                                                        $timeAgo = round($timeAgoUnix / 2628000) . " week ago.";
                                                    } elseif ($timeAgoUnix > 2628000 && $timeAgoUnix < 31535999) {
                                                        // Less than 1 year
                                                        $timeAgo = round($timeAgoUnix / 2628000) . " weeks ago.";
                                                    } elseif ($timeAgoUnix === 31536000) {
                                                        // Exactly 1 year
                                                        $timeAgo = round($timeAgoUnix / 31536000) . " year ago.";
                                                    } elseif ($timeAgoUnix > 31536000) {
                                                        // More than 1 year
                                                        $timeAgo = round($timeAgoUnix / 31536000) . " years ago.";
                                                    } else {
                                                        $timeAgo = "Error";
                                                    }
                                                ?>
                                                <p class="d-inline"> Reported <?= $timeAgo; ?></p>
                                            </div>
                                            <div class="col-sm-4 sensors">
                                                <p class="d-inline">Sensors: </p>
                                                <?php if (strpos($station->sensors, 'T') !== FALSE) { ?>
                                                    <i class="bi bi-thermometer-half"></i>
                                                <?php } if (strpos($station->sensors, 'W') !== FALSE) { ?>
                                                    <i class="bi bi-wind"></i>
                                                <?php } if (strpos($station->sensors, 'R') !== FALSE) { ?>
                                                    <i class="bi bi-cloud-drizzle"></i>
                                                <?php } if (strpos($station->sensors, 'U') !== FALSE) { ?>
                                                    <i class="bi bi-brightness-high"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay"></div>
                        </div>
                        <script type="text/javascript">
                            var map_<?= $station->url; ?> = L.map('map_<?= $station->url; ?>').setView([<?= $station->latitude; ?>, <?= $station->longitude; ?>], 13);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map_<?= $station->url; ?>);
                            L.marker([<?= $station->latitude; ?>, <?= $station->longitude; ?>], {icon: L.divIcon({
                                html: '<i class="bi bi-geo-alt-fill"></i>',
                                iconAnchor: [15, 40],
                                className: 'map-pointer'})
                            }).addTo(map_<?= $station->url; ?>);
                        </script>
                    </a>
                <?php } ?>
            </div>
            <div class="card" data-jplist-control="no-results" data-group="station-list" data-name="no-results">
                <div class="card-body">
                    <p>No Results Found</p>
                </div>
            </div>
            <br>
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
<script type="text/javascript">
    jplist.init({
        storage: 'sessionStorage',
        storageName: 'jplist'
    });

    //var stations = ["Blean", "Canterbury", "Tankerton", "Chatham"];
    //$('.filter-control #inputSearch').suggest(stations);

</script>
