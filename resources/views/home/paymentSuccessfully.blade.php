@extends('layouts.frontend')

@section('content')
    @if($status == 'success')
    <section class="section payment">
        <div class="container">
            <div class="alert alert-success" role="alert">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h2 class="small-title">Поздравляем!</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 card-body">
                        Оплата прошла успешно!<br>
                        Менеджер свяжется с вами для уточнения дальнейшей информации.
                    </div>
                </div>
                <a class="btn back-to-main-page" href="{{route('home')}}">Вернуться на основную страницу</a>
            </div>
        </div>
    </section>
    @else
        <section class="section payment">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mb-5">
                                <h2 class="small-title">Упс, что-то пошло не так!</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 card-body">
                            Возникли проблемы во время оплаты товара.<br>
                            Проверьте состояние счета и правильно ли вы ввели данные карты.
                        </div>
                    </div>
                    <a class="btn back-to-main-page" href="{{route('home')}}">Вернуться на основную страницу</a>
                </div>
            </div>
        </section>
    @endif

@endsection

<style>
    .payment {
        margin-top: 10%;
    }
</style>
