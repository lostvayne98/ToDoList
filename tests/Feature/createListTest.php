<?php

namespace Tests\Feature;

use App\Models\Lists;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
class createListTest extends TestCase
{
    use InteractsWithDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        $user = auth()->loginUsingId(1);

        $this->actingAs($user);

        Storage::fake('local');

        $data = [
            'name' => 'My List',
            'image' => UploadedFile::fake()->image('list.jpg'),
            'tags' => ['tag1', 'tag2', 'tag3'],
            'list_id' => '1'
        ];

        $response = $this->post('/lists', $data);



        $list = Lists::first();

        $this->assertEquals($data['name'], $list->name);

        Storage::assertExists('/user/' . $user->id . '/' . $data['image']->hashName());

        $tags = $list->tags;

        $this->assertCount(count($data['tags']), $tags);

        foreach ($data['tags'] as $tag) {
            $this->assertDatabaseHas('tags', [
                'name' => $tag,
                'lists_id' => $list->id,
                'user_id' => $user->id
            ]);
        }
    }


}
