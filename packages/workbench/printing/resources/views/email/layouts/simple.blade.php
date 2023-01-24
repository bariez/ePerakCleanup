<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@include('ppj::emails.layouts.styles.basic')
</head>
 
<body style="background-color: #f5f8fa !important">

<!-- HEADER -->
<table class="head-wrap  alert-{{ $level }}" bgcolor="#999999">
	<tr>
		<td></td>
		<td class="header container" >
				<div class="content-header">
				<div class="label"><h6 class="collapse">{{ $subject }}</h6></div>
				@unless(is_null($logoUrl = config('app.logo')))
				<div  class="logo">
				<a href="#" target="_blank">
				<img src="{{ $logoUrl }}" width="80" height="80" />
				</a>
				</div>
				@endif
				</div>
				
		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->

			<div class="" style="margin:20px;background-color: #f5f8fa">
									
						
						@foreach($introLines as $line)
	                    <p>{!! $line !!}</p>
	                    @endforeach
						<!-- Callout Panel -->
						@if(isset($actionText))
						<p class="callout {{ $level }}">
							@foreach ($outroLines as $line)
	                        {!! title_case($line) !!}
	                      	@endforeach	
							<br>
							<a href="{{ $actionUrl }}" target="_blank">{{ title_case($actionText) }} &raquo;</a>
						</p><!-- /Callout Panel -->	
						@else
							@foreach ($outroLines as $line)
	                        <p>{!! $line !!}</p>
	                      	@endforeach	
						@endif	

						
						<!-- <button class="ui yellow button">
						  <i class="plus circle icon"></i>
						  <a href="/admin/email/add">TAMBAH</a>
						</button> -->
						
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>Ini adalah mesej cetakan sistem berkomputer. Sistem tidak melayan sebarang email yang dihantar</p>
						
					</td>
				</tr>
			</table>
			</div><!-- /content -->
		
@include('ppj::emails.layouts.footer')
</body>
</html>