<?php

namespace App\Services\Media;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Media\MediaVideo;
use App\Repositories\MediaVideosRepository;

const VIDEO_UPLOADS_DIR = '/uploads/videos/';
const VIDEO_THUMBNAILS_DIR = '/uploads/videos/';
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

    private function createThumbnailUrl($filename)
    {
        return config('app.url').'files?path='.VIDEO_THUMBNAILS_DIR.$filename;
    }

    public function create($data)
    {
        $data['name_slug'] = Str::slug($data['name']);

        if ($data['video_file']) {

            $video = $data['video_file'];
            $videoFilename = Str::slug($video->getClientOriginalName().time()).'.'.$video->getClientOriginalExtension();
            $videoFilepath = VIDEO_UPLOADS_DIR.$videoFilename;
            Storage::disk('public')->put($videoFilepath, file_get_contents($video));

            if ($data['thumbnail_file'])
            {
                $thumbnail = $data['thumbnail_file'];
                $thumbnailFilename = Str::slug($thumbnail->getClientOriginalName().time()).'.'.$thumbnail->getClientOriginalExtension();
                $thumbnailFilepath = VIDEO_UPLOADS_DIR.$thumbnailFilename;

                Storage::disk('public')->put($thumbnailFilepath, file_get_contents($thumbnail));
            }

            $data['video_url'] = $this->createVideoURL($videoFilename);
            $data['thumbnail_url'] = $data['thumbnail_file'] ? $this->createVideoURL($thumbnailFilename) : THUMBNAIL_PLACEHOLDER;

            unset($data['video_file']);
            unset($data['thumbnail_file']);
        }

        return parent::create($data);
    }
}
