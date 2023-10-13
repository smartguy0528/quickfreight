@extends('frontendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4 mt-100">
        <h1 class="mt-4 text-center"> Stripe Payment</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 card mb-4">
                <div class="card-body p-5">
                    <form role="form" action="{{ route('customer.stripe.pay') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        <input type="hidden" name="id" value="{{$quote->quote_id}}">
                        <h3 class="text-muted mb-4">Quote ID: #{{$quote_id}}</h3>
                        <div class='row mb-4'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label>
                                <input class='form-control' size='4' type='text'>
                            </div>
                        </div>

                        <div class='row mb-4'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text' placeholder="4242 4242 4242 4242">
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-xs-12 col-md-4 mb-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 mb-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 mb-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-xs-12 text-center">
                                <button class="btn btn-info bg-info" type="submit"><i
                                    class="fas fa-credit-card"></i> Pay Now (${{$quote->total_cost}})</button>
                            </div>
                            <div class="col-12 mt-3">
                                <a class="text-primary text-uppercase" href="javascript:history.back();"><i class="fas fa-arrow-alt-circle-left"></i> Goto Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
            }
            });

            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }

        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>
@endpush
