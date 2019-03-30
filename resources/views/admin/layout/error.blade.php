@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div> {{--提交表单后错误提醒--}}
@endif