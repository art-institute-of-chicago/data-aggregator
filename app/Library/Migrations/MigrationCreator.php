<?php

namespace App\Library\Migrations;

use Illuminate\Database\Migrations\MigrationCreator as BaseMigrationCreator;

class MigrationCreator extends BaseMigrationCreator
{
    private $stubFilename;

    private $stubPopulator;

    public function setStub($stubFilename)
    {
        $this->stubFilename = $stubFilename;
    }

    public function setPopulator($stubPopulator)
    {
        $this->stubPopulator = $stubPopulator;
    }

    protected function getStub($table, $create)
    {
        if (empty($this->stubFilename)) {
            throw new LogicException('No stub filename defined');
        }

        $stubPath = $this->customStubPath . '/' . $this->stubFilename;

        if (!$this->files->exists($stubPath)) {
            throw new LogicException('Stub does not exist: ' . $stubPath);
        }

        return $this->files->get($stubPath);
    }

    protected function populateStub($stub, $table)
    {
        if (! is_null($table)) {
            $stub = str_replace(
                ['DummyTable', '{{ table }}', '{{table}}'],
                $table,
                $stub
            );
        }

        if (!empty($this->stubPopulator)) {
            $stub = ($this->stubPopulator)($stub);
        }

        return $stub;
    }
}
