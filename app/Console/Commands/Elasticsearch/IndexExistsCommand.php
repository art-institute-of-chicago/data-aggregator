<?php

declare(strict_types=1);

namespace App\Console\Commands\Elasticsearch;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

final class IndexExistsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'laravel-elasticsearch:utils:index-exists
                            {index-name : The index name}';

    /**
     * @var Client
     */
    private $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;

        parent::__construct();
    }

    public function handle(): int
    {
        $indexName = $this->argument('index-name');

        if (!$this->argumentIsValid($indexName)) {
            return self::FAILURE;
        }

        if (
            $this->client->indices()->exists([
            'index' => $indexName,
            ])
        ) {
            $this->output->writeln(
                sprintf(
                    '<info>Index %s exists.</info>',
                    $indexName
                )
            );

            return self::SUCCESS;
        } else {
            $this->output->writeln(
                sprintf(
                    '<comment>Index %s doesn\'t exists.</comment>',
                    $indexName
                )
            );

            return self::SUCCESS;
        }
    }
}
