@extends('layouts.app')

@section('content')
	<div class="container">
		<fieldset>
	          <legend><h4>Signature</h4></legend>
	          <div class="signature-wrapper"><canvas id="signature" class="signature-pad" width="600px" height="150px"></canvas></div>
	          <button id="submit" class="button tiny alert">Submit</button>
	          <button id="clear-signature" class="button tiny alert">Clear</button>
	          <input type="hidden" name="signature" id="signature-input">
		</fieldset>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
		<script src={{asset('js/signature.js')}}></script>
		<script>signature();</script>
	</div>
	@endsection