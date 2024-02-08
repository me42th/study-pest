<div>
<iframe src="https://player.vimeo.com/video/{{$video->vimeo_id}}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    <h3>{{$video->title}}</h3>
    <h3>{{$video->description}}</h3>
    <h3>{{$video->getReadableDuration()}}</h3>


<ul>
    @foreach($courseVideos as $courseVideo)
        <li>
            <a href="{{route('pages.course-videos',$courseVideo)}}">
                {{$courseVideo->title}}
            </a>
        </li>
    @endforeach
</ul>
</div>