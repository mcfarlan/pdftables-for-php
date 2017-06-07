# PDF Tables for PHP

Send PDF documents to [PDF Tables](https://pdftables.com/), via their [API](https://pdftables.com/pdf-to-excel-api) to convert, into CSV, XML, or Excel format. Setup is configured for a Mac environment out-of-box but should work on Linux installs and Windows 10 installs that have the [Creators Update](https://blogs.windows.com/windowsexperience/2017/03/30/managing-windows-10-creators-update-rollout-seamless-experience/#49I5Q8vtTXlsJm4W.97) installed (for \*nix command line).

## Installation

1. Download the [latest](https://github.com/mcfarlan/pdftables-for-php/archive/latest.zip) release.
2. Change configuration values in the [main class](https://github.com/mcfarlan/pdftables-for-php/blob/master/convert.php) to your liking.
3. [Dance](https://www.youtube.com/watch?v=SONH6Kpfta0) and rejoice - you're finished.
4. Use this script on-demand or part of an automated process.

## On-Demand Usage

For on-demand use, double click the `start_conversion.command` file.

## Use in Automated Process

For automated use (by using a tool like [Noodlesoft's Hazel](https://www.noodlesoft.com)), setup a workflow to watch a folder and execute the same `start_conversion.command` file. This can be powerful when part of a Google Drive folder or Dropbox folder.

Alternatively in a server environment, you could make use of a cron job to execute the `.command` file via the `sh` command. Or even better, remove the `start_conversion.command` and make use of `PHP_Tables_PHP::run()` method within a PHP environment.

## Important Notes

- This script was developed for a very particular use and client. As such it probably won't be completely _plug 'n play_ but can be modified to work in part of a standalone ~complex~ use case or automated process with some editing.
- Never, ever, ever save credentials or API keys to a git history. Ever.
- There are no guarantees that this will work for your use case, but with that in mind if you run into problems please [open a new issue](https://github.com/mcfarlan/pdftables-for-php/issues) and I'll be sure to take a look when I can. Or even better, open a [pull request](https://github.com/mcfarlan/pdftables-for-php/pulls) to fix the issue yourself.
- This script is part of an ongoing push to publish more and more of the specialized tools I makes for clients in the hopes that even a single person could benefit from this. If you find this useful, [let me know](mailto:ian@mcfarlan.ca) ;-)

## Possible Roadmap (TBD)

- Composer package for easier integration into PHP environments.
- Simple UI for standalone version running on a local PHP server.
- Better default folder structure and naming for less ambiguity.
