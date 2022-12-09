/*$.fn.triggerInput = function (eventName) {
    return this.each(function () {
        let el = $(this).get(0);
        if (el.fireEvent) {
            (el.fireEvent('on' + eventName));
        } else {
            let evt = document.createEvent('Events');
            evt.initEvent(eventName, true, false);
            el.dispatchEvent(evt);
        }
    });
};

$(document).ready(function() {
    $('body').delegate('#name, #link_name', 'change', function() {
        let slug = $('#slug');

        if (slug.val() != '') {
            return true;
        }

        slug.val($(this).val()
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/ˆ-+|-+$/g, ''))
            .triggerInput('input');
    });
});

Nova.$on('resources-loaded', function () {
    $('.flex-wrap .border-b').css('display', 'block');
    $('.card').before($('.flex-wrap'));
});*/

window.onload = function () {
    document.body.onchange = function (event) {
        let element = event.target,
            slug = document.getElementById('slug'),
            inputEvent = new Event("input");

        if ((element.id === 'name' || element.id === 'link_name') && slug.value === '') {
            slug.value = element.value.toLowerCase().replace(/ /g, '-').replace(/ˆ-+|-+$/g, '');
            slug.dispatchEvent(inputEvent);
        }
    };
};

Nova.$on('resources-loaded', function () {
    let filter = document.getElementsByClassName('flex-wrap')[0],
        card = document.getElementsByClassName('card')[0],
        border = document.getElementsByClassName('border-b')[0],
        parentCard = card.parentNode;

    filter.style = 'display: block';
    border.style = 'display: block';

    parentCard.insertBefore(filter, card);
});