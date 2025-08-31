<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('child_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mother
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Health worker/admin
            $table->string('child_name');
            $table->date('birth_date');
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_records');
    }
};
