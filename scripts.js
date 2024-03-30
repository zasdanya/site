$(function()
{
    $('.test-data').find('div:first').show();

    $('.pagination a').on('click',function()
    {
        if($(this).attr('class')=='nav-active') return false;

        var link=$(this).attr('href');
        var prevActive=$('.pagination>a.nav-active').attr('href');
        $('.pagination>a.nav-active').removeClass('nav-active');
        $(this).addClass('nav-active');
        $(prevActive).fadeOut(100,function()
        {
            $(link).fadeIn();
        });
        return false;
    });
    $('#btn').click(function()
    {
        var test = +$('#test-id').text();
        var res = {'test':test};

        $('.question').each(function()
        {
            var id=$(this).data('id');
            res[id] = $('input[name=question-'+id+']:checked').val();
        });
        console.log(res);
        $.ajax({
            url:"index.php",
            type:'POST',
            data: res,
            success:function(html) 
            {
                $('.content').html(html);
            },
            error: function()
            {
                alert('Error!');
            }
        });
    });
})