<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

abstract class AbstractDumpCommand extends BaseCommand
{

    /**
     * In the interest of defensive coding, you must explicitly whitelist
     * which tables should be exported and imported. Use `dump:audit` to
     * see a list of which tables will be excluded.
     */
    protected $whitelistedTables = [
        'agent_roles',
        'agent_site',
        'agent_types',
        'agents',
        'archival_images',
        'articles',
        'artist_digital_label',
        'artist_product',
        'artwork_artist',
        'artwork_artwork',
        'artwork_asset',
        'artwork_catalogue',
        'artwork_category',
        'artwork_date_qualifiers',
        'artwork_dates',
        'artwork_digital_label',
        'artwork_exhibition',
        'artwork_place',
        'artwork_place_qualifiers',
        'artwork_site',
        'artwork_term',
        'artwork_types',
        'artworks',
        'asset_category',
        'assets',
        'catalogues',
        'category_place',
        'category_terms',
        'closures',
        // 'commands',
        'digital_catalogs',
        'digital_label_exhibitions',
        'digital_labels',
        'educator_resources',
        'event_occurrences',
        'event_programs',
        'events',
        'exhibition_asset',
        'exhibition_site',
        'exhibitions',
        // 'failed_jobs',
        'galleries',
        'generic_pages',
        'hours',
        // 'jobs',
        'legacy_event_exhibition',
        'legacy_events',
        'library_material_creator',
        'library_material_subject',
        'library_materials',
        'library_terms',
        'locations',
        // 'migrations',
        'mobile_artwork_mobile_sound',
        'mobile_artworks',
        'mobile_sounds',
        'places',
        'press_releases',
        'printed_catalogs',
        'products',
        'publications',
        'research_guides',
        'sections',
        'selections',
        'shop_categories',
        'sites',
        'static_pages',
        'tags',
        // 'ticketed_event_types',
        // 'ticketed_events',
        'tour_stops',
        'tours',
        'web_artists',
        'web_exhibitions',
    ];

    /**
     * All of the data dumps live in `database/dumps` per `config/filesystems.php`.
     * Use this to generate absolute paths to CSV files for `createFromPath` calls.
     *
     * @param string $subpath  ...to CSV file, relative to `database/dumps`
     * @return string
     */
    protected function getDumpPath(string $subpath) : string
    {

        return Storage::disk('dumps')->getDriver()->getAdapter()->getPathPrefix() . $subpath;

    }

    /**
     * Use this when you need to run a command interactively or show ouput.
     */
    protected function passthru(string $template, string ...$args)
    {
        return $this->command($template, $args, function(string $cmd) {
            passthru($cmd, $status);
            return [
                'output' => null,
                'status' => $status,
            ];
        });
    }

    /**
     * Use this when you need to capture command output in a variable.
     */
    protected function exec(string $template, string ...$args) : array
    {
        return $this->command($template, $args, function(string $cmd) {
            exec($cmd, $output, $status);
            return [
                'output' => $output,
                'status' => $status,
            ];
        });
    }

    /**
     * Sanitize and run shell command. Exit if it fails. Return output or null.
     */
    protected function command(string $template, array $args, callable $callback)
    {
        $args = array_map('escapeshellarg', $args);
        $cmd = vsprintf($template, $args);

        $this->warn($cmd);

        $return = $callback($cmd);

        $this->warn('Status: ' . $return['status']);

        if ($return['status'] !== 0)
        {
            $this->warn('Something went wrong. Exiting early.');
            exit(1);
        }

        return $return['output'];
    }

    /**
     * Throw an exception if an `.env` var is empty.
     */
    protected function validateEnv(array $vars)
    {
        foreach ($vars as $var)
        {
            if (empty(env($var)))
            {
                throw new Exception('Please specify `' . $var . '` in .env');
            }
        }

    }

}
