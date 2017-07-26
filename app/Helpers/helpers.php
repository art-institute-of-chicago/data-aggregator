<?php

function solr_date ($date) {
    $ret = $date->toIso8601String();
    $ret = substr($ret, 0, strrpos($ret, '-'));
    return $ret .'Z';
}