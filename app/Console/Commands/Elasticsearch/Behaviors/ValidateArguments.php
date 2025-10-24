<?php

namespace App\Console\Commands\Elasticsearch\Behaviors;

trait ValidateArguments
{
    protected function argumentIsValid($indexName): bool
    {
        if (
            $indexName === null ||
            !is_string($indexName) ||
            mb_strlen($indexName) === 0
        ) {
            $this->output->writeln(
                '<error>Argument index-name must be a non empty string.</error>'
            );

            return false;
        }

        return true;
    }

    protected function argumentsAreValid($indexName, $aliasName): bool
    {
        if (
            $indexName === null ||
            !is_string($indexName) ||
            mb_strlen($indexName) === 0
        ) {
            $this->output->writeln(
                '<error>Argument index-name must be a non empty string.</error>'
            );

            return false;
        }

        if (
            $aliasName === null ||
            !is_string($aliasName) ||
            mb_strlen($aliasName) === 0 ||
            !$this->filesystem->exists($aliasName)
        ) {
            $this->output->writeln(
                '<error>Argument alias-name must be a non empty string.</error>'
            );

            return false;
        }

        return true;
    }
}
