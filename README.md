# PDF Tables for PHP

Send PDF documents to [PDF Tables](https://pdftables.com/), via their [API](https://pdftables.com/pdf-to-excel-api) to convert, into CSV, XML, or Excel format. Setup is configured for a Mac environment out-of-box but should work on Linux installs and Windows 10 installs that have the [Creators Update](https://blogs.windows.com/windowsexperience/2017/03/30/managing-windows-10-creators-update-rollout-seamless-experience/#49I5Q8vtTXlsJm4W.97) installed (for \*nix command line).

## Installation

1. Download the [latest](https://github.com/mcfarlan/pdftables-for-php/archive/latest.zip) release.
2. Change configuration values in [`config.php`](https://github.com/mcfarlan/pdftables-for-php/blob/master/config.php) to your liking.
3. [Dance](https://www.youtube.com/watch?v=SONH6Kpfta0) and rejoice - you're finished.

## On-Demand Usage

For on-demand use, double click the `start_conversion.command` file.

## Use in Automated Process

For automated use (by using a tool like [Noodlesoft's Hazel](https://www.noodlesoft.com)), setup a workflow to watch a folder and execute the same `start_conversion.command` file. Alternatively in a server environment, you could make use of a cron job to execute the `.command` file via the `sh` command.
