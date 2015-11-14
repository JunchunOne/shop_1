//.............post传值..................

$(function () {

//....使用ajax post传值....
    $('.ajax_post').click(function () {

        //.....找到当前的表单....
        var from = $(this).closest('form');

        //.....得到url地址.....
        var url = from.length == 0 ? $(this).attr('url') : from.attr('action');

        //....系列化表单....
        var data = from.length == 0 ? $('.id').serialize() : from.serialize();

        $.post(url, data, function (row) {
            var url_1 = row.url;

            //.....调用layer模板....
            layer.msg(row.info, {

                icon: row.status ? 1 : 0,
                offset: 0,
                //shift: 6,
                time: 1000,
            }, function () {

                //由于thinkphp把是ajax请求的自动返回一个json对象,
                if ($('.show').prop('checked') == true) {


                    var num = url_1.lastIndexOf('/');

                    var string = url_1.charAt(num + 1);

                    var url_2 = url_1.replace(string, string - 1);

                    location.href = url_2;

                } else {
                    location.href = url_1;
                }
            });
        })
        return false;
    })

});

//.............get传值........................

$(function () {
    $('.ajax_get').click(function () {
//                $(this).closest('tr').find('td ').first().text();
        //.....得到要传递的url地址.....
        var url = $(this).attr('href');

        //...通过jquery的get方法.....
        $.get(url, function (row) {
            layer.msg(row.info, {
                icon: row.status ? 1 : 0,
                offset: 0,
//                        shift: 6,
                time: 1000,
            }, function () {

                //由于thinkphp把是ajax请求的自动返回一个json对象,
                location.href = row.url;
            });
        })

        //.......阻止默认提交........
        return false;
    });
})


//................批量删除.....................
$(function () {
    //
    $('.show').change(function () {

        $('.id').prop('checked', $(this).prop('checked'));

    })

    $('.id').change(function () {

        //当没有选中的复选框的个数等于0时 class='id' 的复习框就选中
        $('.show').prop('checked', $('.id:not(:checked)').length == 0)
    })

    //......................搜索数据.........................
    $(function () {
        dij();
        function dij(){
        $(".search").on('click',function () {
            //取到要搜索的内容
            var val = $('.keyword').val()

            if (val == '') {
                //event.preventDefault();
                d(1);
                //取消默认提交
                return false;
            }
            //.....找到当前的表单....
            var from = $(this).closest('form');

            //.....得到url地址.....
            var url = from.attr('action');


            //....系列化表单....
            var data = from.serialize();


            //使用ajax
            $.get(url, data, function (row) {
                layer.msg('正在搜索', {
                    icon: 1,
                    offset: 0,
//                        shift: 6,
                    time: 1000,
                }, function () {
                    location.href=url+"&"+data;
                });

            })


            //取消默认提交
            return false;
        })
        }
    })

})