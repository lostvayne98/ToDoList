<?php

namespace App\Http\Controllers\ToDo\Actions;

class StoreAction implements StoreInterface
{

    public function handle(object $model ,array $data):void
    {
        if (!empty($data['tags'])) {


            foreach ($data['tags'] as $tag) {
                $model->tags()->create([
                    'name' => $tag,
                    'user_id' => $model->user_id
                ]);
            }

        }
    }
}
