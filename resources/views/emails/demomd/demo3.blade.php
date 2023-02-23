@component('mail::message')
	# Introduction

	{{ $demo->smsg }}

	@component('mail::button', ['url' => ''])
		Clic aqui

	@endcomponent

	Gracias,<br>
	{{ $demo->dat1 }}
@endcomponent
