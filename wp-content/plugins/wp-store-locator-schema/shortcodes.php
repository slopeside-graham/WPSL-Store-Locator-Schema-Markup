<?php

function wpsl_store_schema()
{
    // Get store options from WP Store Locator
    // Use get_post_meta and find the values in this file: wp-content/plugins/wp-store-locator/frontend/class-frontend.php, line 426 (fronted_meta_fields)
    $storeName = get_the_title();
    $storeID = get_the_ID();

    $storeType = 'ChildCare';

    $storeAddressLine1 = get_post_meta($storeID, 'wpsl_address');
    $storeAddressLine2 = get_post_meta($storeID, 'wpsl_adress2');
    $storeCity = get_post_meta($storeID, 'wpsl_city');
    $storeState = get_post_meta($storeID, 'wpsl_state');
    $storeZip = get_post_meta($storeID, 'wpsl_zip');
    $storeCountry = get_post_meta($storeID, 'wpsl_country');
    $storeLatitude = get_post_meta($storeID, 'wpsl_lat');
    $storeLongitude = get_post_meta($storeID, 'wpsl_lng');

    $storeTel = get_post_meta($storeID, 'wpsl_phone');
    $storeEmail = get_post_meta($storeID, 'wpsl_email');
    $storeHours = get_post_meta($storeID, 'wpsl_hours');
    $storeURL = '';

    if (get_post_meta($storeID, 'wpsl_url')[0]) {
        $storeURL = get_post_meta($storeID, 'wpsl_url')[0];
    } else {
        $storeURL = get_permalink();
    };

    $storeHoursSchema = [];
    foreach($storeHours[0] as $day => $hours) {
        // This is the Goal: ["Mo 10:00-19:00", "Sa 10:00-22:00", "Su 10:00-21:00"]
        // Days are specified using the following two-letter combinations: Mo, Tu, We, Th, Fr, Sa, Su.
        // Times are specified using 24:00 format. For example, 3pm is specified as 15:00, 10am as 10:00.
        if($hours) {
            if ($day === 'monday') {
                $day = 'Mo';
            } else if ($day === 'tuesday') {
                $day = 'Tu';
            } else if ($day === 'wednesday') {
                $day = 'We';
            } else if ($day === 'thursday') {
                $day = 'Th';
            } else if ($day === 'friday') {
                $day = 'Fr';
            } else if ($day === 'saturday') {
                $day = 'Sa';
            } else if ($day === 'sunday') {
                $day = 'Su';
            }
            $arrayHours = explode(',', $hours[0]);
            $openingTime = date("H:i", strtotime($arrayHours[0]));
            $closingTime = date("H:i", strtotime($arrayHours[1]));

            array_push($storeHoursSchema, $day . ' ' . $openingTime . '-' . $closingTime);
        };
    };

    // Organization Info - Replace these with settings from the WP Admin
    $organizationName = 'The Nest School';
    $organizationType = 'EducationalOrganization';
    $organizationURL = 'https://thenestschool.com/';
    $organizationLogo = '';
    $organizationImage = '';
    $organizationDescription = 'At The Nest Schools Childcare Center, each day is a promise to our families. Our mission to build strong minds, healthy bodies, and happy kids is at the heart of every decision we make.';

    // Output the Schema
    $output = '';

    $output .= '<span>Schema</span><br />';

    $output .= '<script type="application/ld+json">';
        $output .= '{';
            $output .= '"@context": "https://schema.org",';
            $output .= '"@type": "' . $storeType . '",';
            $output .= '"name": "' . $organizationName . ' - ' . $storeName . '",';
            $output .= '"logo": "",';
            $output .= '"image": "",';
            $output .= '"url": "' . $storeURL . '",';
            $output .= '"openingHours": ["' . implode("\", \"", $storeHoursSchema) . '"],';
            $output .= '"sameAs": [';
            $output .= '""';
            $output .= '],';
            $output .= '"address": {';
                $output .= '"@type": "PostalAddress",';
                $output .= '"addressLocality": "' . $storeCity[0] . '",';
                $output .= '"addressRegion": "' . $storeState[0] . '",';
                $output .= '"postalCode": "' . $storeZip[0] . '",';
                $output .= '"streetAddress": "' . $storeAddressLine1[0] . ' ' . $storeAddressLine2[0] . '",';
                $output .= '"addressCountry": "' . $storeCountry[0] . '"';
            $output .= '},';
            $output .= '"geo": {';
                $output .= '"@type": "GeoCoordinates",';
                $output .= '"latitude": "' . $storeLatitude[0] . '",';
                $output .= '"longitude": "' . $storeLongitude[0] . '"';
            $output .= '},';
        $output .= '"email": "' . $storeEmail[0] . '",';
        $output .= '"telephone": "' . $storeTel[0] . '",';
            $output .= '"branchOf": {';
                $output .= '  "@type": "' . $organizationType . '",';
                $output .= '  "name": "' . $organizationName . '",';
                $output .= '  "url": "' . $organizationURL . '",';
                $output .= '  "logo": "'. $organizationLogo . '",';
                $output .= '  "image": "' . $organizationImage . '",';
                $output .= ' "description": "' . $organizationDescription . '"';
                $output .= '}'; 
            $output .= '}';
        $output .= ' }';
    $output .= '</script>';

    return $output;
};

add_shortcode('wpsl_store_schema', 'wpsl_store_schema');
