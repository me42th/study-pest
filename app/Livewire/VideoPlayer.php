<?php

namespace App\Livewire;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video, $courseVideos;

    public function mount():void
    {
        $this->courseVideos = $this->video->course->videos()->get();
    }

    public function render(): View
    {
        return view('livewire.video-player');
    }
}
