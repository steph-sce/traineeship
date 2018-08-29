<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // as usually we take care of erasing all images before beginning seeding
        Storage::disk('local')->delete(Storage::allFiles());

        App\Category::create([
            'name' => 'DevOPS'
        ]);
        App\Category::create([
            'name' => 'Javascript'
        ]);
        App\Category::create([
            'name' => 'PHP'
        ]);
        App\Category::create([
            'name' => 'Soft skills'
        ]);

        factory(App\Post::class, 20)->create()->each(function($post){
            $link = str_random(12) . '.jpg';
            $file = file_get_contents('https://picsum.photos/2500/2500?image=' . rand(1,40));
            Storage::disk('local')->put($link, $file);


            $category = App\Category::find(rand(1,4));
            $post->categories()->attach($category);

            $post->picture()->create([
                'title' => 'Default',
                'link' => $link
            ]);
        });
    }
}
