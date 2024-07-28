<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('subject_schedule_id');
            $table->integer('create_by')->nullable()->after('teacher_id');
            $table->integer('level_id')->nullable()->after('create_by');
            $table->integer('module_id')->nullable()->after('level_id');
            $table->integer('main_location_id')->nullable()->after('module_id');
            $table->integer('location_id')->nullable()->after('main_location_id');
            $table->string('room_no')->nullable()->after('location_id');
            $table->string('floor')->nullable()->after('room_no');
            $table->text('note')->nullable()->after('floor');
            $table->text('notice')->nullable()->after('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            
        });
    }
};
