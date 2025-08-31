<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maternal_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mother or creator
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Health worker/admin
            $table->date('visit_date');
            $table->integer('gestational_age')->nullable();
            $table->float('weight')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maternal_records');
    }
};
