{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
      </head>
      <body>
      <form id="payment-form" action="{{route('payment.store')}}" method="post">
          <!-- Putting the empty container you plan to pass to
            `braintree.dropin.create` inside a form will make layout and flow
            easier to manage -->
            @csrf
            @method('POST')

          <div id="dropin-container"></div>
          <input type="submit" />
          <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </form>
      
        <script type="text/javascript">
          // call braintree.dropin.create code here

            const form = document.getElementById('payment-form');

            braintree.dropin.create({
            authorization: '{{$clientToken}}',
            container: '#dropin-container'
            }, (error, dropinInstance) => {
            if (error) console.error(error);

            form.addEventListener('submit', event => {
                event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);

            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            document.getElementById('nonce').value = payload.nonce;
            form.submit();
        });
  });
});
        </script>
      </body>
</html> --}}

@extends('layouts.app')

<style>

  #dashboard{
    width: 70%;
    margin: 100px auto;
  }


</style>

@section('content')

    <div id="dashboard">

        <h1> Acquista sponsorizzazione </h1>

        <form id="payment-form" action="{{route('payment.store', $id)}}" method="post">
            <!-- Putting the empty container you plan to pass to
              `braintree.dropin.create` inside a form will make layout and flow
              easier to manage -->
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="sponsorship"> Type sponsorship </label>
                <select name="sponsorship">

                    @foreach ($types_sponsorship as $sponsorship)
                        <option value="{{$sponsorship -> name}}"> {{$sponsorship -> name}} - {{$sponsorship -> price}}</option>
                    @endforeach

                </select>
            </div>

            <input type="hidden" value="{{$id}}" name="property_id">

            <div id="dropin-container"></div>
            <input type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </form>

    </div>

    <script type="text/javascript">
        // call braintree.dropin.create code here

          const form = document.getElementById('payment-form');

          braintree.dropin.create({
          authorization: '{{$clientToken}}',
          container: '#dropin-container'
          }, (error, dropinInstance) => {
          if (error) console.error(error);

          form.addEventListener('submit', event => {
              event.preventDefault();

          dropinInstance.requestPaymentMethod((error, payload) => {
          if (error) console.error(error);

          // Step four: when the user is ready to complete their
          //   transaction, use the dropinInstance to get a payment
          //   method nonce for the user's selected payment method, then add
          //   it a the hidden field before submitting the complete form to
          //   a server-side integration
          document.getElementById('nonce').value = payload.nonce;
          form.submit();
        });
        });
        });
      </script>
@endsection