<?php

declare(strict_types=1);

namespace App\Console\Commands\Elasticsearch;

use App\Console\Commands\Elasticsearch\Behaviors\ValidateArguments;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;
use Throwable;

final class IndexCreateCommand extends Command
{
    use ValidateArguments;

    /**
     * @var string
     */
    protected $signature = 'laravel-elasticsearch:utils:index-create
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
                    '<error>Index %s already exists and cannot be created.</error>',
                    $indexName
                )
            );

            return self::FAILURE;
        }

        try {
            $this->client->indices()->create([
                'index' => $indexName,
            ]);
        } catch (Throwable $exception) {
            $this->output->writeln(
                sprintf(
                    '<error>Error creating index %s, exception message: %s.</error>',
                    $indexName,
                    $exception->getMessage()
                )
            );

            return self::FAILURE;
        }

        $this->output->writeln(
            sprintf(
                '<info>Index %s created.</info>',
                $indexName
            )
        );

        return self::SUCCESS;
    }
}
