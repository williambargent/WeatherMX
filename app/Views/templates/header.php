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
?>
<!--
 * WeatherMX - an elegant, free, open-source web application built to display data form CumulusMX; the USB weather stations data logger.
 * https://github.com/williambargent/WeatherMX
 *
 * @author William Bargent code@williambargent.co.uk
 * 
 * @copyright Copyright (c) 2022, William Bargent
 * @license AGPL-3.0 - https://github.com/williambargent/WeatherMX/blob/main/LICENSE_WEATHERMX
 * 
 -->

<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="googlebot" content="index, follow">
        <meta http-equiv="Cache-control" content="public">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="generator" content="Codeigniter 3.1.10" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="An elegant, free, open-source web application built to display data from CumulusMX; the weather stations data logger."/>
        <meta name="keywords" content="WeatherMX CumulusMX"/>
        <meta name="author" content="William Bargent">
        <meta name="title" content="<?= $page_title ?> - WeatherMX" />
        <meta name="application-name" content="WeatherMX"/>
        <title><?= $page_title ?> - WeatherMX</title>
        
        <link rel="canonical" href="<?= base_url(); ?>">
        <link rel="alternate" href="<?= base_url(); ?>" hreflang="en-gb" />
        
        <link rel="dns-prefetch" href="https://fonts.googleapis.com">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link rel="dns-prefetch" href="https://stackpath.bootstrapcdn.com">
        <link rel="dns-prefetch" href="https://code.jquery.com">
        <link rel="dns-prefetch" href="https://unpkg.com">
        <link rel="dns-prefetch" href="https://tile.openstreetmap.org">
        
        <link rel="manifest" href="<?= base_url('/assets/img/logo/manifest.json'); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('/assets/img/logo/favicon-32x32.png'); ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('/assets/img/logo/favicon-96x96.png'); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/assets/img/logo/favicon-16x16.png'); ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url('/assets/img/logo/android-icon-192x192.png'); ?>">
        <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('/assets/img/logo/apple-icon-57x57.png'); ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('/assets/img/logo/apple-icon-60x60.png'); ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('/assets/img/logo/apple-icon-72x72.png'); ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('/assets/img/logo/apple-icon-76x76.png'); ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('/assets/img/logo/apple-icon-114x114.png'); ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('/assets/img/logo/apple-icon-120x120.png'); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('/assets/img/logo/apple-icon-144x144.png'); ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('/assets/img/logo/apple-icon-152x152.png'); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('/assets/img/logo/apple-icon-180x180.png'); ?>">
        <meta name="msapplication-TileImage" content="<?= base_url('/assets/img/logo/ms-icon-144x144.png'); ?>">
        <meta name="msapplication-TileColor" content="#fff">
        <meta name="theme-color" content="#1565C0" />
        
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="<?= base_url('assets/main.css'); ?>">
        
        <!-- Javascript -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="navigation">
                <nav class="nav navbar-top">
                    <div class="fluid-container">
                        <ul class="nav justify-content-end ml-auto unit-control">
                            <li class="nav-item">
                                <a class="nav-link" href="https://github.com/williambargent/WeatherMX" target="_blank"> <i class="bi bi-github"></i> </a>
                            </li>
                        </ul>
                    </div> <!-- END fluid-container -->
                </nav> <!-- END navbar-top -->
                <nav class="navbar navbar-expand-lg  navbar-inner">
                    <div class="fluid-container">
                        <a class="navbar-brand" href="/">
                            <i class="bi bi-thermometer-half" style="font-size: 1.5rem;"></i>
                            <span class="font-weight-bold">W</span>eather<span class="font-weight-bold">MX</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-inner" aria-controls="navbar-inner" aria-expanded="false" aria-label="Toggle Navigation">
                            <i class="fas fa-bars fa-lg"></i>
                        </button>
                        <button class="navbar-toggler navbar-toggler-all_stations" type="button">
                            All Stations
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-inner">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item <?php if (strpos($page_title, 'Home') !== FALSE) { echo 'active'; } ?>">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item <?php if (strpos($page_title, 'All Stations') !== FALSE) { echo 'active'; } ?>">
                                    <a class="nav-link" href="/stations/all-stations">All Stations</a>
                                </li>
                                <li class="nav-item dropdown <?php if (strpos($page_title, 'About') !== FALSE) { echo 'active'; } ?>">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About <i class="bi bi-caret-down-fill"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/about#data">The Data</a>
                                        <a class="dropdown-item" href="/about#owner">The Owner</a>
                                        <a class="dropdown-item" href="https://williambargent.co.uk">The Creator</a>
                                        <a class="dropdown-item" href="/about#licence">The Licences</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="https://github.com/williambargent/WeatherMX/blob/master/README.md"><span class="font-weight-bold">W</span>eather<span class="font-weight-bold">MX</span></a>
                                        <a class="dropdown-item" href="https://cumuluswiki.wxforum.net/a/Cumulus_MX">CumulusMX</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="https://github.com/williambargent/WeatherMX">GitHub Project</a>
                                    </div> <!-- END dropdown-menu -->
                                </li>
                                <li class="nav-item <?php if (strpos($page_title, 'Help') !== FALSE) { echo 'active'; } ?>">
                                    <a class="nav-link" href="/help">Help</a>
                                </li>
                                <li class="nav-item <?php if (strpos($page_title, 'Admin') !== FALSE) { echo 'active'; } ?>">
                                    <a class="nav-link" href="https://identity.williambargent.co.uk">Admin</a>
                                </li>
                            </ul>
                        </div> <!-- END navbar-collapse -->
                    </div> <!-- END fluid-container -->
                </nav> <!-- END navbar-inner -->
            </div> <!-- END navigation -->
            <main>
                <div class="fluid-container">
