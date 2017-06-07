<?php

/**
 * Converts PDFs to CSVs, XML, or XLSX
 */
class PDF_Tables_PHP {

    private $api_key                  = '';             // Plugin your API key from https://pdftables.com/pdf-to-excel-api
    private $format                   = 'csv';          // Possible formats include 'csv', 'xml', 'xlsx-single', 'xlsx-multiple'
    private $save_conversion_here     = 'csv';          // Name of the folder you would like to save the converted file to; relative path
    private $move_processed_pdfs_here = 'processed';    // Move all processed PDFs to this folder; relative path

    function __construct() {
        $this->dir      =  __DIR__ . '/';
        $this->files    = array_diff( scandir( __DIR__ ), $this->ignore_these_files() );
    }

    private function ignore_these_files() {
        $ignore_these_files   = array(
            '..',
            '.',
            'convert.php',
            'csv',
            '.DS_Store',
            'processed',
            'start_conversion.command'
        );

        return $ignore_these_files;
    }

    public function run() {
        if ( ! is_array( $this->files ) || empty( $this->files ) ) {
            print 'No files to convert';
            return;
        }

        foreach ( $this->files as $file ) {
            $this->maybe_convert_file( $file );
        }

        return $this->api_key;
    }

    private function which_format_ext( $format ) {
        if ( $format == 'csv' || $format == 'xml' ) {
            return $format;
        } else if ( $format == 'xlsx-single' || $format == 'xlsx-multiple' ) {
            return 'xlsx';
        }
    }

    private function maybe_convert_file( $file ) {
        if ( substr( $file, -3 ) == 'pdf' && substr( $file, -3 != 'csv' ) ) {
            convert_to_csv( $file );

            if ( copy( $file, 'processed/'. $file ) ) {
                unlink( $file );
            }
        }
    }

    private function convert_to_csv( $file ) {
        $the_curl   = curl_init();
        $filename   = substr( $file, 0, -4 );
        $file       = curl_file_create( $file, 'application/pdf' );
        $format_ext = $this->which_format_ext( $this->format );

        curl_setopt( $the_curl, CURLOPT_URL, 'https://pdftables.com/api?key=' . $api_key . '&format=' . $this->format );
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
}

$app = new PDF_Tables_PHP();
$app->run();
