<?php

function wpsl_store_schema()
{
    // Get store options from WP Store Locator
    // Use get_post_meta and find the values in this file: wp-content/plugins/wp-store-locator/frontend/class-frontend.php, line 426 (fonted_meta_fields)
    $storeName = '';
    $storeID = get_the_ID();

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
    $storeURL = get_post_meta($storeID, 'wpsl_url');

    print_r($storeAddressLine1[0]);

    // Below is a basic example of what is needed in the schema


    /*
<script type="application/ld+json">
    {
        "@context": "https:\/\/schema.org",
        "@type": "ChildCare",
        "name": "Kids 'R' Kids",
        "logo": "https:\/\/kidsrkids.com\/west-frisco\/wp-content\/uploads\/sites\/2\/2018\/12\/krk_logo.png",
        "image": "https:\/\/kidsrkids.com\/west-frisco\/wp-content\/uploads\/sites\/2\/2018\/12\/krk_logo.png",
        "url": "https:\/\/kidsrkids.com\/west-frisco",
        "sameAs": [
            "http:\/\/www.youtube.com\/user\/kidsrkidscorporate",
            "http:\/\/www.facebook.com\/kidsrkidscorporate",
            "http:\/\/www.twitter.com\/kidsrkidscorp",
            "https:\/\/plus.google.com\/110315008907308268607\/",
            "http:\/\/www.pinterest.com\/krkcorporate"
        ],
        "address": "2660 Main St  Frisco TX US 75033",
        "email": "info@krkwestfrisco.com",
        "telephone": "972-712-7332\t",
        "awards": "Cognia, Best of Metroplex, Consumer Choice Award, Double Platinum Award, Texas School Ready",
        "branchOf": {
            "@type": "organization",
            "name": "Kids 'R' Kids",
            "address": "1625 Executive Drive South  Duluth GA  30096"
        }
    }
</script>
*/
};

add_shortcode('wpsl_store_schema', 'wpsl_store_schema');
