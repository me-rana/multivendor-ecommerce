<?php

if (!function_exists('DummyFunction')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function routeHelper($url)
    {
        if (auth()->user()->role_id == 1) {
            $fixed_url = '/admin/';
        } 
        else if (auth()->user()->role_id == 2) {
            $fixed_url = '/vendor/';
        }
        else if (auth()->user()->role_id == 4) {
            $fixed_url = '/affiliate/';
        }
        else if (auth()->user()->role_id == 5) {
            $fixed_url = '/import-exporter/';
        }

        return $fixed_url.$url;
    }
}
