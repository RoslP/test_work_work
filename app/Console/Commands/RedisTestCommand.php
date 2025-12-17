<?php

namespace App\Console\Commands;

use App\Http\Controllers\TestJobController;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        Post::factory()->count(500)->create();
//        Post::all()->each(function (Post $post) {
//            Cache::put('post:' . $post->id, $post);
//        });
//        $before = microtime(true);
//        $posts = Cache::get("post:all");
//        $after = microtime(true);
//
//        $dbBefore = microtime(true);
//        $posts = Post::all();
//        $dbAfter = microtime(true);
//
//        dd('Время в кеше : ' .  $after - $before . '\n' . 'Время в базе : ' .
//             $dbAfter - $dbBefore
//        );        Post::all()->each(function (Post $post) {
//            Cache::put('post:' . $post->id, $post);
//        });
//        $before = microtime(true);
//        $posts = Cache::get("post:all");
//        $after = microtime(true);
//
//        $dbBefore = microtime(true);
//        $posts = Post::all();
//        $dbAfter = microtime(true);
//
//        dd('Время в кеше : ' .  $after - $before . '\n' . 'Время в базе : ' .
//             $dbAfter - $dbBefore
//        );

        $controller = new TestJobController;
        $controller->test();
        dump(123);
    }
}
