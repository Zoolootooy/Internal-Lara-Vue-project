{{ __('Здравствуйте, ')}} {{ $mail['user_name'] }}!<br><br>

{{ __('Вы сделали новый заказ на сайте') }}:
<a href="{{ $mail['sender_site'] }}">{{ $mail['sender_site'] }}<a><br>
        {{ __('Идентификатор заказа') }}: {{$mail['order_id']}}<br>
        {{ __('Вы покупаете:') }}<br><br>
        {{ __('Основной набор карт') }}: {{$mail['price']}}<br>
        @if(count($mail['extern_cards_list']) > 1)
            {{ __('Дополнительные наборы карт:') }}<br>
            @foreach($mail['extern_cards_list'] as $tag)
                {{ $tag }}<br>
            @endforeach
        @endif
        @if(count($mail['extern_cards_list']) == 1)
            {{ __('Дополнительный набор карт:') }}
            {{ $mail['extern_cards_list'] }}.
            <br>
        @endif
        <br>
        {{ __('Доставка товара будет выполнена по адресу') }}: {{ $mail['address'] }}<br>
        {{ __('Менеджер свяжется с вами по номеру') }}: {{ $mail['phone'] }}<br><br>
        {{ __('К оплате') }}: {{ $mail['total_price'] }} {{ __('грн') }}<br><br>

        {{ __('C вами свяжется менеджер для подтверждения заказа.') }}<br>
        {{ __('C найлучим пожеланиями') }}<br><br>
{{ config('app.name') }}
