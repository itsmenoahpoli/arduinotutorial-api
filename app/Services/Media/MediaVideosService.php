<?php

namespace App\Services\Media;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Media\MediaVideo;
use App\Repositories\MediaVideosRepository;

const VIDEO_UPLOADS_DIR = '/uploads/videos/';
const THUMBNAIL_PLACEHOLDER = 'https://placehold.co/600x400?text=no+video+available';

class MediaVideosService extends MediaVideosRepository
{
    public function __construct(public MediaVideo $model)
    {
        parent::__construct($model);
    }

    private function createVideoURL($filename)
    {
        return config('app.url').'files?path='.VIDEO_UPLOADS_DIR.$filename;
    }

    public function create($data)
    {
        $data['name_slug'] = Str::slug($data['name']);

        if ($data['video_file']) {

            $video = $data['video_file'];

            $filename = $video->getClientOriginalName().time().'.'.$video->getClientOriginalExtension();
            $filepath = VIDEO_UPLOADS_DIR.$filename;

            Storage::disk('public')->put($filepath, file_get_contents($video));

            $data['video_url'] = $this->createVideoURL($filename);
            $data['thumbnail_url'] = $data['thumbnail_file'] ? Storage::url('thumbnails/' . $data['name_slug'] . '.png') : THUMBNAIL_PLACEHOLDER;

            unset($data['video_file']);
            unset($data['thumbnail_file']);
        }

        return parent::create($data);
    }
}
