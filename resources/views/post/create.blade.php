@extends('layout.main')
@section('content')
<div class="col-sm-8 blog-main">
    <form action="/posts" method="POST">
        {{ csrf_field() }}
        {{--<input type="hidden" name="_token" value="{{csrf_token()}}"> --}}{{--加token，防止csrf攻击--}}
        <div class="form-group">
            <label>标题</label>
            <input name="title" type="text" class="form-control" placeholder="这里是标题">
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
        </div>
        @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
           @foreach($errors->all() as $error)
               <li>{{$error}}</li>
               @endforeach
        </div> {{--提交表单后错误提醒--}}
        @endif
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    <br>

</div><!-- /.blog-main -->
@endsection
{{--<script >--}}
    {{--var editor = new wangEditor('content');--}}
    {{--editor.create();--}}
{{--</script>--}}