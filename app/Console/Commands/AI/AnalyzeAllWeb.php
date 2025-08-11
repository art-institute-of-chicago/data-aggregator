<?php

namespace App\Console\Commands\AI;

use App\Behaviors\HandleEmbeddings;
use App\Behaviors\ImportsData;
use App\Console\Commands\BaseCommand;
use App\Services\DescriptionService;
use App\Models\Collections\Artwork;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Sleep;
use Symfony\Component\Console\Output\OutputInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AnalyzeAllWeb extends BaseCommand
{
    use HandleEmbeddings;
    use ImportsData;

    protected $signature = 'ai:analyze-all-web
                            {model? : Model to process, e.g. `\\App\\Models\\Web\\Article`}';

    protected $description = 'Analyze all web content';

    protected $sleepFor = 1 / 10;  // 0.1 seconds or 100 milliseconds

    public function handle()
    {
        $this->info($this->getAicLogo(), OutputInterface::VERBOSITY_VERBOSE);

        $this->api = config('resources.sources.web');

        $model = $this->argument('model');

        if ($model) {
            $this->analyzeFromWeb($model);
            $this->info("Imported {$model} web CMS content!");
        } else {
            $this->analyzeModels();
            $this->info('Imported all web CMS content!');
        }
    }

    protected function analyzeModels()
    {
        $this->analyzeFromWeb(\App\Models\Web\Article::class);
        $this->analyzeFromWeb(\App\Models\Web\Highlight::class);
        $this->analyzeFromWeb(\App\Models\Web\LandingPage::class);
        $this->analyzeFromWeb(\App\Models\Web\DigitalPublicationArticle::class);
        $this->analyzeFromWeb(\App\Models\Web\PrintedPublication::class);
    }

    protected function analyzeFromWeb($model)
    {
        $endpoint = app('Resources')->getEndpointForModel($model);

        $this->warn('Analyzing model ' . $model);

        $model::chunk(200, function (Collection $items) use ($endpoint) {
            foreach ($items as $item) {
                $this->info("Analyzing #{$item->id}: " . $item->title);
                $this->updateSentryTags($item, $endpoint, 'Web');

                try {
                    $this->generateAndSaveWebEmbeddngs($item, $this);
                } catch (Exception $e) {
                    $errors[] = [
                        'id' => $item->id,
                        'title' => $item->title,
                        'error' => $e->getMessage()
                    ];
                }
            }
        });

        Sleep::for($this->sleepFor)->seconds();
    }
}
