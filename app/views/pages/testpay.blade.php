



@extends('layouts.default')
@section('content')
<style>
#content_pay {
	margin-bottom: 500px;
}
</style>
<div id = "content_pay">
    <form action="testcharge" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_4ujZrZIZnpNkS2vh2isDqLQ7"
    data-amount="100"
    data-name="Demo Site"
    data-description=""
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png">
  </script>
  <input type = "hidden" name = "amount" value = "100"/>
  
  
</form>
</div>
@stop
