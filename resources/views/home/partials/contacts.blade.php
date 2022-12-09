<section class="section bg-white" id="contacts">
    <div class="container">
        <div class="alert alert-success mb-5 hidden" v-if="forms[0].isSent">
            {!! __('Your message is successfully sent.<br />We will contact you as soon as possible.') !!}
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-9">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">{{ __('Contact us') }}</h5>
                                    <span>{{ __('Ask us any questions') }}</span>
                                </div>
                            </div>
                            <div class="col-3 pt-3">
                                <img src="/images/icons/mail.png" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2 pt-4">

                            {!! Form::openSp(['route' => ['send']]) !!}

                                {!! Form::errorList($errors) !!}

                                {!! Form::emailFieldSp('sender_email', __('Email'), ['value' => old('sender_email'), 'singlePage' => true]) !!}

                                {!! Form::textFieldSp('sender_name', __('Name'), ['value' => old('sender_name')]) !!}

                                {!! Form::textFieldSp('subject', null, ['value' => old('subject')]) !!}

                                {!! Form::textAreaFieldSp('body', __('Message'), ['value' => old('body')]) !!}

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light" :disabled="forms[0].errors.any()">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="forms[0].showLoader"></span> &nbsp;
                                        {{ __('Send') }}
                                    </button>
                                </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
