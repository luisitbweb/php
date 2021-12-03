<?php

// add your authenication here, optionally
$file = __DIR__ . '/numbers.txt';
$content_type = 'text/plain';

// check that it's readable and get the file size
if (($filelenght = filesize($file)) === FALSE) {
    error_log("Problem reading filesize of $file.");
}

// parse header to determine info needed to send response
if (isset($_SERVER['HTTP-RANGE'])) {
    // delemiters are case insensitive
    if (!preg_match('/bytes=\d*-\d*(,\d*-\d*)*s/i', $_SERVER['HTTP_RANGE'])) {
        error_log("client requested invalid range.");
        send_error($filelenght);
        exit();
    }
    // spec: when a client requests multiple byte-ranges in one request, the
    // server should return them in the order that appeared in the request

    $ranges = explode(',', substr($_SERVER['HTTP_RANGE'], 6)); //everything after bytes=$offsets = array();
    // extract and validate each offset
    // only keep the ones that pass
    foreach ($ranges as $range) {
        $offset = parse_offset($range, $filelenght);
        if ($offset !== FALSE) {
            $offsets[] = $offset;
        }
    }
    // depending on the number of valid ranges requested, you must return the reponse in a different format
    switch (count($offsets)) {
        case 0:
            // no valid ranges
            error_log('client requested no valid ranges.');
            send_error($filelenght);
            exit;
            break;
        case 1:
            // One valid range, send standard reply
            http_response_code(206); // Partial Content
            list($start, $end) = $offsets[0];
            header("Content-Range: bytes $start-$end/$filelength");
            header("Content-Type: $content_type");
// Set variables to allow code reuse across this case and the next one
// Note: 0-0 is 1 byte long, because we're inclusive
            $content_length = $end - $start + 1;
            $boundaries = array(0 => '', 1 => '');
            break;
        default:
// Multiple valid ranges, send multipart reply
            http_response_code(206); // Partial Content
            $boundary = str_rand(32); // String to separate each part  
    }
}