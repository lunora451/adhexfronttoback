<?php


function fetchWithCurl($url, $options = [])
{

    $curl = curl_init();

    $defaultOptions = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,  // Return response as string
        CURLOPT_TIMEOUT => 30,           // Timeout after 30 seconds
        CURLOPT_FOLLOWLOCATION => true,  // Follow redirects
        CURLOPT_SSL_VERIFYPEER => true,  // Verify SSL certificates
        CURLOPT_USERAGENT => 'PHP-Script/1.0'
    ];


    $curlOptions = array_merge($defaultOptions, $options);

    // Set cURL options
    curl_setopt_array($curl, $curlOptions);

    // Execute request
    $response = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        $error = curl_error($curl);
        curl_close($curl);
        throw new Exception("cURL Error: " . $error);
    }

    // Get response info
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);

    curl_close($curl);

    return [
        'body' => $response,
        'http_code' => $httpCode,
        'content_type' => $contentType,
        'success' => $httpCode >= 200 && $httpCode < 300
    ];
}
