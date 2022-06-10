<?php

namespace Database\Seeders;

use App\Models\Metrics;
use App\Models\MetricSource;
use App\Services\SiteSpeed\Models\SiteSpeedMetric;
use Illuminate\Database\Seeder;

class SiteSpeedMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $metrics = collect([
        //     'coach_score',
        //     'coach_bestpractice_score',
        //     'coach_bestpractice_amp',
        //     'coach_bestpractice_charset',
        //     'coach_bestpractice_cumulativeLayoutShift',
        //     'coach_bestpractice_doctype',
        //     'coach_bestpractice_language',
        //     'coach_bestpractice_metaDescription',
        //     'coach_bestpractice_optimizely',
        //     'coach_bestpractice_pageTitle',
        //     'coach_bestpractice_spdy',
        //     'coach_bestpractice_url',
        //     'coach_bestpractice_longHeaders',
        //     'coach_bestpractice_manyHeaders',
        //     'coach_bestpractice_thirdParty',
        //     'coach_bestpractice_unnecessaryHeaders',
        //     'coach_performance_score',
        //     'coach_performance_avoidRenderBlocking',
        //     'coach_performance_avoidScalingImages',
        //     'coach_performance_cssPrint',
        //     'coach_performance_firstContentfulPaint',
        //     'coach_performance_googleTagManager',
        //     'coach_performance_inlineCss',
        //     'coach_performance_jquery',
        //     'coach_performance_largestContentfulPaint',
        //     'coach_performance_longTasks',
        //     'coach_performance_spof',
        //     'coach_performance_assetsRedirects',
        //     'coach_performance_cacheHeaders',
        //     'coach_performance_cacheHeadersLong',
        //     'coach_performance_compressAssets',
        //     'coach_performance_connectionKeepAlive',
        //     'coach_performance_cpuTimeSpentInRendering',
        //     'coach_performance_cpuTimeSpentInScripting',
        //     'coach_performance_cssSize',
        //     'coach_performance_documentRedirect',
        //     'coach_performance_favicon',
        //     'coach_performance_fewFonts',
        //     'coach_performance_fewRequestsPerDomain',
        //     'coach_performance_headerSize',
        //     'coach_performance_imageSize',
        //     'coach_performance_javascriptSize',
        //     'coach_performance_mimeTypes',
        //     'coach_performance_optimalCssSize',
        //     'coach_performance_pageSize',
        //     'coach_performance_privateAssets',
        //     'coach_performance_responseOk',
        //     'coach_privacy_score',
        //     'coach_privacy_facebook',
        //     'coach_privacy_fingerprint',
        //     'coach_privacy_ga',
        //     'coach_privacy_https',
        //     'coach_privacy_surveillance',
        //     'coach_privacy_youtube',
        //     'coach_privacy_contentSecurityPolicyHeader',
        //     'coach_privacy_disableFLoCHeader',
        //     'coach_privacy_googleReCaptcha',
        //     'coach_privacy_mixedContent',
        //     'coach_privacy_referrerPolicyHeader',
        //     'coach_privacy_strictTransportSecurityHeader',
        //     'coach_privacy_thirdPartyCookies',
        //     'coach_privacy_thirdPartyPrivacy',
        //     'browsertime_timings_fullyLoaded',
        //     'browsertime_timings_largestContentfulPaint',
        //     'browsertime_googleWebVitals_cumulativeLayoutShift',
        //     'browsertime_googleWebVitals_largestContentfulPaint',
        //     'browsertime_googleWebVitals_firstContentfulPaint',
        //     'browsertime_googleWebVitals_firstInputDelay',
        //     'browsertime_googleWebVitals_totalBlockingTime',
        //     'browsertime_pageinfo_cumulativeLayoutShift',
        //     'browsertime_firstPaint',
        //     'browsertime_navigationTiming_connectStart',
        //     'browsertime_navigationTiming_domComplete',
        //     'browsertime_navigationTiming_domContentLoadedEventEnd',
        //     'browsertime_navigationTiming_domContentLoadedEventStart',
        //     'browsertime_navigationTiming_domInteractive',
        //     'browsertime_navigationTiming_domainLookupEnd',
        //     'browsertime_navigationTiming_domainLookupStart',
        //     'browsertime_navigationTiming_duration',
        //     'browsertime_navigationTiming_fetchStart',
        //     'browsertime_navigationTiming_loadEventEnd',
        //     'browsertime_navigationTiming_loadEventStart',
        //     'browsertime_navigationTiming_requestStart',
        //     'browsertime_navigationTiming_responseEnd',
        //     'browsertime_navigationTiming_responseStart',
        //     'browsertime_navigationTiming_secureConnectionStart',
        //     'browsertime_navigationTiming_unloadEventEnd',
        //     'browsertime_navigationTiming_unloadEventStart',
        //     'browsertime_pageTimings_backEndTime',
        //     'browsertime_pageTimings_domContentLoadedTime',
        //     'browsertime_pageTimings_domInteractiveTime',
        //     'browsertime_pageTimings_domainLookupTime',
        //     'browsertime_pageTimings_frontEndTime',
        //     'browsertime_pageTimings_pageDownloadTime',
        //     'browsertime_pageTimings_pageLoadTime',
        //     'browsertime_pageTimings_redirectionTime',
        //     'browsertime_pageTimings_serverConnectionTime',
        //     'browsertime_pageTimings_serverResponseTime',
        //     'browsertime_paintTiming_first-contentful-paint',
        //     'browsertime_paintTiming_first-paint',
        //     'browsertime_userTimings_marks',
        //     'browsertime_visualMetrics_FirstVisualChange',
        //     'browsertime_visualMetrics_LastVisualChange',
        //     'browsertime_visualMetrics_SpeedIndex',
        //     'browsertime_visualMetrics_videoRecordingStart',
        //     'browsertime_visualMetrics_VisualReadiness',
        //     'browsertime_visualMetrics_VisualComplete85',
        //     'browsertime_visualMetrics_VisualComplete95',
        //     'browsertime_visualMetrics_VisualComplete99',
        //     'browsertime_cpu_longTasks_tasks',
        //     'browsertime_cpu_longTasks_totalDuration',
        //     'browsertime_cpu_longTasks_totalBlockingTime',
        //     'browsertime_cpu_longTasks_maxPotentialFid',
        //     'browsertime_cpu_categories_parseHTML',
        //     'browsertime_cpu_categories_styleLayout',
        //     'browsertime_cpu_categories_paintCompositeRender',
        //     'browsertime_cpu_categories_scriptParseCompile',
        //     'browsertime_cpu_categories_scriptEvaluation',
        //     'browsertime_cpu_categories_garbageCollection',
        //     'browsertime_cpu_categories_other',
        //     'pagexray_transferSize',
        //     'pagexray_contentSize',
        //     'pagexray_requests',
        //     'pagexray_contentTypes_html_transferSize',
        //     'pagexray_contentTypes_html_contentSize',
        //     'pagexray_contentTypes_html_requests',
        //     'pagexray_contentTypes_css_transferSize',
        //     'pagexray_contentTypes_css_contentSize',
        //     'pagexray_contentTypes_css_requests',
        //     'pagexray_contentTypes_javascript_transferSize',
        //     'pagexray_contentTypes_javascript_contentSize',
        //     'pagexray_contentTypes_javascript_requests',
        //     'pagexray_contentTypes_image_transferSize',
        //     'pagexray_contentTypes_image_contentSize',
        //     'pagexray_contentTypes_image_requests',
        //     'pagexray_contentTypes_font_transferSize',
        //     'pagexray_contentTypes_font_contentSize',
        //     'pagexray_contentTypes_font_requests',
        //     'pagexray_contentTypes_plain_transferSize',
        //     'pagexray_contentTypes_plain_contentSize',
        //     'pagexray_contentTypes_plain_requests',
        //     'pagexray_contentTypes_other_transferSize',
        //     'pagexray_contentTypes_other_contentSize',
        //     'pagexray_contentTypes_other_requests',
        //     'pagexray_contentTypes_json_transferSize',
        //     'pagexray_contentTypes_json_contentSize',
        //     'pagexray_contentTypes_json_requests',
        //     'pagexray_responseCodes_200',
        //     'pagexray_responseCodes_302',
        //     'pagexray_responseCodes_403',
        //     'pagexray_firstParty_transferSize',
        //     'pagexray_firstParty_contentSize',
        //     'pagexray_firstParty_requests',
        //     'pagexray_thirdParty_transferSize',
        //     'pagexray_thirdParty_contentSize',
        //     'pagexray_thirdParty_requests',
        //     'pagexray_domains',
        //     'pagexray_cookies',
        //     'pagexray_expireStats',
        //     'pagexray_lastModifiedStats'
        // ]);

        // $metrics->each(function ($metric) {
        //     SiteSpeedMetric::updateOrCreate(
        //         [
        //             'metric_key' => $metric
        //         ],
        //         [
        //             'metric_key' => $metric
        //         ],
        //     );
        // });

        $sitespeedMetrics = SiteSpeedMetric::orderBy('sitespeed_metric_id')->get();

        $sitespeedMetrics->each(function ($metric) {
            Metrics::updateorCreate(
                [
                    'metric_source_id' => MetricSource::SITESPEED,
                    'metric_key' => $metric->metric_key
                ],
                [
                    'metric_source_id' => MetricSource::SITESPEED,
                    'metric_key' => $metric->metric_key,
                    'metric_priority_id' => $metric->metric_priority_id ?? 5,
                    'unit_of_measure_id' => $metric->unit_of_measure_id ?? 1,
                    'name' => $metric->name,
                    'reference_key' => $metric->sitespeed_metric_id,
                    'minimum_threshold' => $metric->minimum_treshold,
                    'maximum_threshold' => $metric->maximum_threshold
                ]
            );
        });
    }
}
