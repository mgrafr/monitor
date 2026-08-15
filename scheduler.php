<?php require_once __DIR__.'/vendor/autoload.php';

use GO\Scheduler;

// Create a new scheduler
$scheduler = new Scheduler();

// ... configure the scheduled jobs (see below) ...
$scheduler->php(
    '/www/monitor/custom/php/services.php', // The script to execute
    '/usr/bin/php', // The PHP bin
    'custom_services'
)->hourly();
// Let the scheduler execute jobs which are due.
$scheduler->run();
