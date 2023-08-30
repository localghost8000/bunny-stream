<?php

namespace Laborb\BunnyStream\Tags;
 
class VideoStyles extends \Statamic\Tags\Tags
{
    protected static $handle = 'video_styles';

    public function css() {
        return '<link href="https://cdn.laborb.de/bunny-stream-assets/videojs.css" rel="stylesheet" />';
    }

    public function js() {
       return '<script src="https://cdn.laborb.de/bunny-stream-assets/video.min.js"></script>';
    }
}