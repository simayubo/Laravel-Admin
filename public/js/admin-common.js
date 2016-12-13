$(document).pjax("a[href!='#']", '.pjax');
$(document).on('pjax:start', function() { NProgress.start(); });
$(document).on('pjax:end',   function() { NProgress.done();  });
$(document).on("pjax:timeout", function(event) {
    // 阻止超时导致链接跳转事件发生
    event.preventDefault()
});
//删除
function del(id) {
    layer.confirm('你确认删除此条记录吗吗？', {
        btn: ['确认','取消']
    }, function(){
        $('form[name=delete-'+id+']').submit();
    });
}
