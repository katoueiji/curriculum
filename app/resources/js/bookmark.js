$(function ()
{
    $('.send').on('click', function ()
    {
        event_id = $(this).attr('event_id');
        bkm_product = $(this).attr('bkm_product');
        click_button = $(this);

        $.ajax({
            url: '/bkm_product',
            type: 'post',
            data: {
                event_id: event_id,
                bkm_product: bkm_product,
                _token: '{{ csrf_token() }}'
            },
        })
        .done(function (data)
        {
            if ( data == 0 )
            {
                click_button.attr("bkm_product", "1");
                click_button.children().attr("class", "bi bi-bookmark-fill text-primary");
            }
            if ( data == 1 )
            {
                click_button.attr("bkm_product", "0");
                click_button.children().attr("class", "bi bi-bookmark text-secondary");
            }
        })
    })
})