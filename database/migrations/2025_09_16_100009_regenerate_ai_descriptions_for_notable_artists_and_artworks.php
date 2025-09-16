<?php

use App\Console\Commands\AI\SummarizeDescription;
use App\Models\Collections\Agent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {

        // 'monet', 'van gogh', 'picasso', 'matisse', 'hokusai', 'degas',
        // 'warhol', 'renoir', 'rembrandt', 'manet', 'hopper', 'seurat',
        // 'cezanne', 'rothko', 'magritte', 'gauguin', 'caravaggio', 'klimt',
        // 'cassatt', 'chagall', 'klee', 'rodin', 'mondrian', 'dali',
        // 'sargent', 'rivera', 'o\'keeffe', 'caillebotte', 'grant wood',
        // 'jasper johns', 'henri de toulouse-lautrec'

        $artistIds = [35809, 40610, 36198, 35670, 31492, 40543, 37219, 35351, 40769, 35577, 34996, 40810, 40482, 36467, 15965, 34611, 42037, 14096, 33890, 33909, 35282, 36418, 17549, 34123, 22980, 36397, 36062, 3829, 37343, 35139, 40869];

        foreach ($artistIds as $id) {
            $artist = Agent::with(['webArtist', 'createdArtworks'])->find($id);

            if (!$artist) {
                continue;
            }

            $artworks = $artist->createdArtworks;

            if (count($artworks) > 0) {
                foreach ($artworks as $artwork) {
                    Log::info("(ID: {$artwork->id}) | {$artwork->title}\n");

                    Artisan::call('ai:summarize', [
                    '--id' => $artwork->id,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        // https://www.youtube.com/watch?v=MOveYAuDJvw (You know we can't go back)
    }
};
