<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->text('offset_program')->change();

            if (!Schema::hasColumn('payments', 'program_count')) {
                $table->unsignedTinyInteger('program_count')->default(1)->after('offset_program');
            }

            if (!Schema::hasColumn('payments', 'split_amount')) {
                $table->decimal('split_amount', 15, 2)->default(0)->after('program_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('offset_program')->change();

            if (Schema::hasColumn('payments', 'program_count')) {
                $table->dropColumn('program_count');
            }

            if (Schema::hasColumn('payments', 'split_amount')) {
                $table->dropColumn('split_amount');
            }
        });
    }
};