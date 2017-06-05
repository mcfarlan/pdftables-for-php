<?php

$dir = __DIR__ . '/';
require_once $dir . 'config.php';

$files = array_diff( scandir( __DIR__ ), $ignore_these_files );

foreach( $files as $file ):

    // Only PDFs
    if ( substr( $file, -3 ) == 'pdf' && substr( $file, -3 != 'csv' ) ) {

        convert_to_csv( $file );

        if ( copy( $file, 'processed/'. $file ) ) {
            unlink( $file );
        }

    }

endforeach;

if ( $api_key !== '' ) {
    return $api_key;
}

/**
 * Sends a PDF to PDF Tables API for conversion
 *
 * @param string    $file
 */
function convert_to_csv( $file ) {
    $the_curl   = curl_init();
    $filename   = substr( $file, 0, -4 );
    $file       = curl_file_create( $file, 'application/pdf' );
    $format_ext = which_format_ext( $format );

    curl_setopt( $the_curl, CURLOPT_URL, 'https://pdftables.com/api?key=' . $api_key . '&format=' . $format );
    curl_setopt( $the_curl, CURLOPT_POSTFIELDS, array( 'file' => $file ) );
    curl_setopt( $the_curl, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $the_curl, CURLOPT_ENCODING, 'gzip,deflate' );

    $result = curl_exec( $the_curl );
    if ( curl_errno( $the_curl ) ) {
        print( 'Oh Dear! Error calling PDFTables: ' . curl_error( $the_curl ) );
    }

    // Save PDF converstion to file
    file_put_contents ( $filename . '.' . $format_ext , $result );

    // Close the connection
    curl_close( $the_curl );

    // Relax the connection to allow for latency
    sleep( 2 );

    // Move the converted file into the processed folder
    if ( copy( $filename . '.' . $format_ext, $save_conversion_here . '/' . $filename . '.' . $format_ext ) ) {
        unlink( $filename . '.' . $format_ext );
    }

}

/**
 * Determine the file extension to save the conversion
 *
 * @param string    $format
 */
function which_format_ext( $format ) {
    if ( $format == 'csv' || $format == 'xml' ) {
        return $format;
    } else if ( $format == 'xlsx-single' || $format == 'xlsx-multiple' ) {
        return 'xlsx';
    }
}
