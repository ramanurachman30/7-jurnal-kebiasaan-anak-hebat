<?php

namespace App\Services;

use App\Models\ImageContent;

class ImageContentService
{
    public function store($data, $contentId)
    {
        foreach ($data as $key => $value) {
            ImageContent::create([
                'content_invitations_id' => $contentId,
                'sort' => $key,
                'name' => $value
            ]);
        }
    }

    public function find($id)
    {
        return ImageContent::find($id);
    }

    public function delete($id)
    {
        ImageContent::where('id', $id)->delete();
    }
}
