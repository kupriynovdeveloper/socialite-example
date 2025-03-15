<?php

use App\Models\Category;
use App\Models\Image;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->boolean('is_published')->default(0);
            $table->foreignIdFor(Profile::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Image::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('view')->default(0);
            $table->boolean('no_comments')->nullable()->default(0);
            $table->dateTime('published_at')->default(DateTimeImmutable::createFromFormat('Y.m.d H:m', date('Y.m.d H:m'), new \DateTimeZone('Europe/Moscow'))->format('Y.m.d H:m'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
