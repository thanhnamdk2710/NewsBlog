<form action="{{route('postForm')}}" method="post">
    {{ csrf_field() }}
    <input type="text" name="yourname">
    <input type="submit">
</form>