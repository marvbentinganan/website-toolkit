# Description

This is the agent that collects data from various sources. This is composed of the following Services.

- WordPress Agent
- Sitespeed Metrics
- SnipeIT Assets

## Installation

- Clone project and update the `.env`. Make sure to update the SnipeIT database connection as we need to pull the domains and servers from SnipeIT.
- Install dependencies. `composer install`
- Run the Migrations. `php artisan migrate`
- Run the Seeders. `php artisan db:seed`
- Import and Process data from SnipeIT

## Services

### Forge

This service retrieves the Servers and Domains from Laravel Forge API.

#### Available Artisan Commands

- `php artisan wtk:import-forge-servers` - import servers from Laravel Forge
- `php artisan wtk:import-forge-sites` - import sites from Laravel Forge
- `php artisan wtk:process-forge-servers` - process imported servers from Laravel Forge
- `php artisan wtk:process-forge-sites` - process imported sites from Laravel Forge

### Log Parser

This service receives parsed nginx logs from the [Log Parser Agent](https://github.com/marvbentinganan/log-parser).

#### Available Artisan Commands

- `php artisan wtk:parse-logs` - process the data from import_web_server_logs table.

### SiteSpeed

This service dispaches a job to scan domains using sitespeed.io. Make sure to set the `sitespeed_check` to `true` in the domains table for sites you want to scan.

#### Available Artisan Commands

- `php artisan wtk:sitespeed-scan` - dispatches a job to run a sitespeed scan for every domain that has `sitespeed_check` set to true in the domains table. You can also provide an argument of the `domain_id` of the domain you want to scan.
- `php artisan wtk:sitespeed-process` - this will process the data in `import_sitespeed_data` table to store the metrics for each domain.