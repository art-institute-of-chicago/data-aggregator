<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->jsonb('vocab_ids')->nullable()->after('ulan_certainty');
            $table->string('wikidata_id')->nullable()->after('vocab_ids');
            $table->decimal('match_confidence', 4, 3)->nullable()->after('wikidata_id');
            $table->string('match_source')->nullable()->after('match_confidence');
        });
    }

    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn(['vocab_ids', 'wikidata_id', 'match_confidence', 'match_source']);
        });
    }
};
