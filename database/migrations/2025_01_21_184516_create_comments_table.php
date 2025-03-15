<?php

use App\Models\Comment;
use App\Models\File;
use App\Models\Post;
use App\Models\Profile;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->foreignIdFor(Comment::class, 'parent_id')
                ->nullable()
                ->constrained('comments')
                ->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->unsignedInteger('view')->default(0);
            $table->foreignIdFor(Profile::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
