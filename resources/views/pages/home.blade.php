@guest()
    <a href="{{route('login')}}" >Login</a>
@else
    <form action="{{route('logout')}}" method="post">
        @csrf
        <input type="submit" value="Log out">
    </form>
@endguest
@foreach($courses as $course)
{{$course->title}} {{$course->description}}
@endforeach