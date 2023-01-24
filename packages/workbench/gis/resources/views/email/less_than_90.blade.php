<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@include('site::email.layouts.styles.basic')
@include('site::email.layouts.styles.all')
@include('site::email.layouts.styles.semantic')	
</head>
 
<body bgcolor="#DCC2EE !important;"> <!-- #f5f8fa -->

<!-- HEADER -->
<table class="head-wrap  alert-" bgcolor="{!!$background_color!!}" width="100%">
	<tr>
		<td></td>
		<td class="header container" >
				<div class="content-header">
				<div class="label"><h6 class="collapse"  style="color:{!!$color!!}">{{$header}}</h6></div>
				
				</div>
				
		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap" bgcolor="#f5f8fa" width="100%" style="border-collapse: collapse;">
	<tr>
		<td class="container" >
			<div class="content" style="margin: 0px 0px !important; max-width:initial !important;">
			

			<p>
				Project {{$project_no}} {{$developer_name}} is due for commissioning in less than 90 day’s. Please conduct IOM meeting immediately. If IOM meeting has been conducted, please update IOM Meeting Date.</p>
			
			</div><!-- /content -->
									
		</td>
	</tr>
</table><!-- /BODY -->
</body>
</html>