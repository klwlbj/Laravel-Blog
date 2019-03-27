// var editor = new wangEditor('content');
//
// editor.config.uploadImgUrl = '/posts/image/upload';  //要加路由
//
// // 设置 headers（举例）
// editor.config.uploadHeaders = {
//     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') //传头部的token
// };
//
// editor.create();
var E = window.wangEditor;
var editor = new E('#div1');
var $text1 = $('#content');
editor.customConfig.menus = [
    'head',  // 标题
    'bold',  // 粗体
    'fontSize',  // 字号
    'fontName',  // 字体
    'italic',  // 斜体
    'underline',  // 下划线
    'strikeThrough',  // 删除线
    'foreColor',  // 文字颜色
    'backColor',  // 背景颜色
    'link',  // 插入链接
    'image',  // 插入图片

]
editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
editor.customConfig.onchange = function (html) {
    // 监控变化，同步更新到 textarea
    $text1.val(html);
}
editor.create();
// 初始化 textarea 的值
$text1.val(editor.txt.html());

//ajax 加 token
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
//like绑定事件
$('.like-button').click(function (event) {
    var target = $(event.target);
    var current_like = target.attr('like-value');//获取值
    var user_id = target.attr('like-user');
    if(current_like ==1 ){
        //取消关注
        $.ajax({
            url:'/user/'+user_id+'/unfan',
            method:'post',
            dataType:'json',
            success:function(data){
                if(data.error!= 0){
                    alert(data.msg);
                    return;
                }
                target.attr('like-value',0);
            target.text('关注');
        }
        })
    }
    else{
        //取消
        $.ajax({
            url:'/user/'+user_id+'/fan',
            method:'post',
            dataType:'json',
            success:function(data){
                if(data.error!= 0){
                    alert(data.msg);
                    return;
                }
                target.attr('like-value',1);
                target.text('取消关注');
            }
        })
    }

})
