<?php

namespace App\Console\Commands\Update;

use App\Models\Collections\Asset;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class UpdateNetx extends BaseCommand
{
    protected $signature = 'update:netx';

    protected $description = 'Adds NetX id for all assets';

    public function handle()
    {
        $assets = Asset::where('id', 'regexp', '^[0-9]+$')
            ->whereNull('netx_uuid');

        foreach ($assets->cursor() as $asset) {
            $asset->netx_uuid = Asset::getHashedId($asset->id);
            $asset->save();

            $this->info($asset->id . ' => ' . $asset->netx_uuid);
        }
    }
}
