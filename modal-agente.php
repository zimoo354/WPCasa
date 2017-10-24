<div id="modal" class="iziModal">
	<div class="row">
		<div class="small-12 medium-10 medium-push-1 columns">
			<h1>Ponte en contacto con <br><b></b></h1>
			<form id="form-contacto">
				<input type="hidden" name="destino" value="">
				<input type="hidden" name="persona" value="">
				<div class="input-group"><input placeholder="Enter your full name" type="text" required name="nombre"></div>
				<div class="input-group"><input placeholder="Email" type="email" required name="mail"></div>
				<div class="input-group"><input placeholder="Phone Number" type="tel" required name="telefono"></div>
				<div class="input-group"><input placeholder="Your message" type="text" required name="mensaje"></div>
				<button type="button" onclick="sendContact()">Send</button>
				<input type="submit" class="hide display-none">
			</form>
		</div>
	</div>
</div>