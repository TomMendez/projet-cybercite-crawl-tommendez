<?php
include 'Client.php';

    $config = json_decode(file_get_contents("config.json"), true);
    $datagarden = new Client(
        $config['user'],
        $config['password'],
        $config['url']);
    $siteId = $config['site']['id'];
