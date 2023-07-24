<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        foreach ([
            'articles',
            'digital_publication_sections',
            'issue_articles',
            'issues',
        ] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn(['date']);
            });
        }
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->timestamp('date')->nullable()->after('title');
        });

        Schema::table('digital_publication_sections', function (Blueprint $table) {
            $table->timestamp('date')->nullable()->after('heading');
        });

        Schema::table('issue_articles', function (Blueprint $table) {
            $table->timestamp('date')->nullable()->after('title');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->timestamp('date')->nullable()->after('title');
        });
    }
};
