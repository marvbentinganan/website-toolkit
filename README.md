# Description

This is the agent that collects data from various sources. This is composed of the following Services.

- Laravel Forge
- Sitespeed Metrics
- Nginx Logs
- Postmark
- Datadog

## Installation

- Clone project and update the `.env`
- Install dependencies. `composer install`
- Run the Migrations. `php artisan migrate`
- Run the Seeders. `php artisan db:seed`

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

### Datadog

This service retrieves the Hosts from Datadog.

#### Available Artisan Commands

- `php artisan wtk:import-datadog-hosts` - import servers from Datadog.
- `php artisan wtk:import-process-hosts` - import sites from Datadog.

### Postmark

This service retrieves the Servers and Metrics from Postmark API.

#### Available Artisan Commands

- `php artisan wtk:import-postmark-servers` - import servers from Postmark
- `php artisan wtk:import-postmark-stats` - import metrics from Postmark
- `php artisan wtk:process-postmark-servers` - process imported servers from Postmark
- `php artisan wtk:process-postmark-stats` - process imported metrics from Postmark
