<?php

$api_key                  = '';             // Plugin your API key from https://pdftables.com/pdf-to-excel-api
$format                   = 'csv';          // Possible formats include 'csv', 'xml', 'xlsx-single', 'xlsx-multiple'
$save_conversion_here     = 'csv';          // Name of the folder you would like to save the converted file to; relative path
$move_processed_pdfs_here = 'processed';    // Move all processed PDFs to this folder; relative path

// The script will only convert PDFs but this is good if you wanted to ignore some files.
$ignore_these_files   = array(
    '..',
    '.',
    'convert.php',
    'csv',
    '.DS_Store',
    'processed',
    'start_conversion.command'
);
