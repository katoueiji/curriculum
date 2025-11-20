
$(function ()
{
    $('.send').on('click', function ()
    {
        const click_button = $(this);
        const event_id = click_button.data('event-id');
        const bookmark = click_button.data('bookmark');
        const url = click_button.data('url');

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: url,
            type: 'post',
            data: {
                'event_id': event_id,
                'bookmark': bookmark,
            },
            dataType: 'json'
        })
        .done(function (data)
        {
            if ( data.status === 'added')
            {
                click_button.data("bookmark", 1);
                click_button.find('i').attr("class", "bi bi-bookmark-fill text-primary");
            }
            else {
                click_button.data("bookmark", 0);
                click_button.find('i').attr("class", "bi bi-bookmark text-secondary");
            }
        })
    })
})