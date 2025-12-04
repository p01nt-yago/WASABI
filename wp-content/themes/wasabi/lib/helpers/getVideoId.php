<?php

function extract_video_id($url) {

    // YouTube
    if (preg_match('~(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $url, $matches)) {
        return [
            'type' => 'youtube',
            'id'   => $matches[1],
        ];
    }

    // Vimeo
    if (preg_match('~vimeo\.com/(?:video/)?([0-9]+)~', $url, $matches)) {
        return [
            'type' => 'vimeo',
            'id'   => $matches[1],
        ];
    }

    return false;
}
