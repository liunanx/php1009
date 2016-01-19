$(function(){


  //使用复选框的全选功能
  $('.checkAll').click(function(){
    $('.ids').prop('checked',$(this).prop('checked'));
  });
  $('.ids').click(function(){
    $('.checkAll').prop('checked',$('.ids:not(:checked)').length==0);
  });

  //ajax的get请求
  $('.ajax-get').click(function(){
    //发送ajax请求,从当前标签上获取url地址
    var url = $(this).attr('href');
    //回调函数中的data表示响应数据
    $.get(url,showAjaxLayer);
    return false;
  });


  //ajax的post请求
  $('.ajax-post').click(function(){
    //发送ajax请求，通过closest方法找到form标签
    var form = $(this).closest('form');
    /*
    //找到form标签上的地址
    var url = form.attr('action');
    //序列化所发送的数据
    var params = form.serialize();
    //通过post异步传输数据
    $.post(url,params,showAjaxLayer);
    */
    //如果没有form，为批量删除
    if(form.length!=0){
      //jquery.form方式 此方式通过表单对象直接提交数据
      form.ajaxSubmit({success:showAjaxLayer});
    }else{
      //找到批量删除标签上的地址
      var url = $(this).attr('url');
      //序列化所发送的数据
      var params = $('.ids:checked').serialize();
      //通过post异步传输数据
      $.post(url,params,showAjaxLayer);
    }

    return false;
  });

  function showAjaxLayer(data){
    //设置表情类型
    var icon;
    if(data.status){
      icon = 6;    //操作成功
    }else{
      icon = 5;    //操作失败
    }
    layer.msg(data.info,{
      time:1000,
      icon:icon

    },function(){
      if(data.url){
        location.href=data.url;
      }
    });
  }
})