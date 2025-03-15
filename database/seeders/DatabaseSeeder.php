<?php

namespace Database\Seeders;

use App\Enums\CommentStatus;
use App\Models\Category;
use App\Models\Comment;
use App\Models\File;
use App\Models\Image;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*$user = [
            'login' => 'User',
            'email' => 'test@example.com',
            'password' => '12345678'
        ];
        $user = User::query()->firstOrCreate(['email' => $user['email']], $user);
        $roles = Role::factory(3)->create();

        $user->profiles()->firstOrCreate(['user_id' => $user->id], [
            'last_name' => 'Sergei',
            'role_id' => $roles->random()->pluck('id')->first()
        ]);*/

        /*// Пост 1: Основы работы с Laravel
        $post1 = Post::factory()
            ->create([
                'title' => 'Основы Laravel: установка и начальная настройка',
                'text' => 'В этом уроке мы рассмотрим процесс установки Laravel и его первичной настройки. От скачивания до запуска первого приложения.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Фреймворк')->first()->id,
                'view' => 150,
                'published_at' => Carbon::now(),
            ]);

// Пост 2: Работа с миграциями
        $post2 = Post::factory()
            ->create([
                'title' => 'Мастерская работа с миграциями в Laravel',
                'text' => 'Полное руководство по созданию и управлению миграциями в Laravel. От базового CRUD до сложных операций.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Фреймворк')->first()->id,
                'view' => 75,
                'published_at' => Carbon::now()->subDays(2),
            ]);

// Пост 3: Автентификация
        $post3 = Post::factory()
            ->create([
                'title' => 'Система аутентификации в Laravel',
                'text' => 'Как создать безопасную систему входа и регистрации пользователей с использованием встроенного Sanctum.',
                'is_published' => false,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Фреймворк')->first()->id,
                'view' => 0,
                'published_at' => Carbon::tomorrow(),
            ]);

// Пост 4: API разработка
        $post4 = Post::factory()
            ->create([
                'title' => 'Разработка REST API на Laravel',
                'text' => 'Создание современного REST API с использованием ресурсов и контроллеров Laravel.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Фреймворк')->first()->id,
                'view' => 45,
                'published_at' => Carbon::now()->subWeek(),
            ]);*/

        /*        // Пост 1: SOLID принципы
        $post1 = Post::factory()
            ->create([
                'title' => 'Применение принципов SOLID в Laravel',
                'text' => 'Глубокое погружение в принципы SOLID и их практическое применение при разработке на Laravel. От S до D.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Архитектура')->first()->id,
                'view' => 120,
                'published_at' => Carbon::now(),
            ]);

// Пост 2: Микросервисы
        $post2 = Post::factory()
            ->create([
                'title' => 'Микросервисная архитектура на Laravel',
                'text' => 'Как разбить монолит на микросервисы и организовать их взаимодействие с помощью Laravel.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Архитектура')->first()->id,
                'view' => 85,
                'published_at' => Carbon::now()->subDays(3),
            ]);

// Пост 3: Event-Driven
        $post3 = Post::factory()
            ->create([
                'title' => 'Event-Driven разработка в Laravel',
                'text' => 'События и слушатели в Laravel: от базового использования до сложных сценариев.',
                'is_published' => false,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Архитектура')->first()->id,
                'view' => 0,
                'published_at' => Carbon::tomorrow(),
            ]);

// Пост 4: CQRS
        $post4 = Post::factory()
            ->create([
                'title' => 'CQRS паттерн в Laravel',
                'text' => 'Разделение операций чтения и записи с помощью паттерна CQRS в Laravel приложениях.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Архитектура')->first()->id,
                'view' => 60,
                'published_at' => Carbon::now()->subWeek(),
            ]);*/

        /*// Создание тегов для поста о SOLID
        $post1 = Post::find(9);
        $post1->tags()->attach([
            Tag::firstOrCreate(['title' => 'SOLID'])->id,
            Tag::firstOrCreate(['title' => 'принципы-проектирования'])->id,
            Tag::firstOrCreate(['title' => 'объектно-ориентированное-программирование'])->id
        ]);

// Создание тегов для поста о микросервисах
        $post2 = Post::find(10);
        $post2->tags()->attach([
            Tag::firstOrCreate(['title' => 'микросервисы'])->id,
            Tag::firstOrCreate(['title' => 'архитектура'])->id,
            Tag::firstOrCreate(['title' => 'масштабирование'])->id
        ]);

// Создание тегов для поста о Event-Driven
        $post3 = Post::find(11);
        $post3->tags()->attach([
            Tag::firstOrCreate(['title' => 'event-driven'])->id,
            Tag::firstOrCreate(['title' => 'события'])->id,
            Tag::firstOrCreate(['title' => 'асинхронная-обработка'])->id
        ]);

// Создание тегов для поста о CQRS
        $post4 = Post::find(12);
        $post4->tags()->attach([
            Tag::firstOrCreate(['title' => 'CQRS'])->id,
            Tag::firstOrCreate(['title' => 'паттерны'])->id,
            Tag::firstOrCreate(['title' => 'базы-данных'])->id
        ]);*/

        /*$post1 = Post::factory()
            ->create([
                'title' => 'Docker для разработчиков: от базы до продакшена',
                'text' => 'Полное руководство по настройке и использованию Docker в разработке. От установки до деплоя.',
                'is_published' => true,
                'profile_id' => Profile::query()->find(1)->id,
                'category_id' => Category::where('title', 'Девопс')->first()->id,
                'view' => 150,
                'published_at' => Carbon::now(),
            ]);*/

        /*// Комментарии к посту о Docker
        $post1 = Post::find(1);

// Уровень 1 - прямые комментарии
        $comment1 = Comment::factory()
            ->create([
                'text' => 'Отличная статья! Начал использовать Docker после вашей статьи.',
                'status' => CommentStatus::APPROVED,
                'view' => 15,
                'profile_id' => Profile::query()->find(1)->id,
                'post_id' => Post::find(13)->first()->id,
            ]);

        $comment2 = Comment::factory()
            ->create([
                'text' => 'А как настроить Docker на Windows? У меня не получается.',
                'status' => CommentStatus::PENDING,
                'view' => 8,
                'profile_id' => Profile::query()->find(1)->id,
                'post_id' => Post::find(13)->first()->id,
            ]);

// Уровень 2 - ответы на комментарии
        $comment3 = Comment::factory()
            ->create([
                'text' => 'На Windows лучше использовать Docker Desktop. Скачайте с официального сайта.',
                'status' => CommentStatus::APPROVED,
                'view' => 12,
                'parent_id' => $comment2->id,
                'profile_id' => Profile::query()->find(1)->id,
                'post_id' => Post::find(13)->first()->id,
            ]);*/

        /*// Для поста
        $post = Post::find(13);
        $post->likes()->attach(2);

        // Для комментария
        $comment = Comment::find(1);
        $comment->likes()->attach(2);*/
    }
}
