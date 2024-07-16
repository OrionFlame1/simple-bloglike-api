<?php
    function vdd($text) { // debugging purposes
        echo '<pre>';
        print_r($text);
        echo '</pre>';
        exit;
    }

    function format($response, $format) {
        if($format) {
            return '<pre>' . $response . '</pre>';
        }
        return $response;
    }
?>