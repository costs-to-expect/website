<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

/**
 * Basic static sitemap
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class SitemapController extends BaseController
{
    /**
     * Sitemap covering the known static routes, first pass only, the
     * API driven category/subcategory/year/month routes are not yet included
     *
     * @return Response
     */
    public function index(): Response
    {
        $urls = [
            ['loc' => url('/'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('/jack'), 'changefreq' => 'daily', 'priority' => '0.8'],
            ['loc' => url('/niall'), 'changefreq' => 'daily', 'priority' => '0.8'],
            ['loc' => url('/about'), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('/what-we-count'), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('/changelog'), 'changefreq' => 'monthly', 'priority' => '0.3'],
            ['loc' => url('/privacy-policy'), 'changefreq' => 'yearly', 'priority' => '0.2'],
        ];

        $xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= '    <url>' . "\n";
            $xml .= '        <loc>' . htmlspecialchars($url['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>' . "\n";
            $xml .= '        <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            $xml .= '        <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '    </url>' . "\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
