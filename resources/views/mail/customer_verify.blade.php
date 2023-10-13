<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Verify your email</title>
</head>
<body>
	<h3>Hello, {{$mailData['name']}} </h3>
	<p>Please tab the below link to verify your request.</p>
    <a href="{{route('customer.verify', $mailData['token'])}}" target="_blank" style="display: inline-block; background-color: lightblue; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #ffffff; text-decoration: none; border-radius: 0;">Verify Your Email</a>
	<br>
	<br>
	<small>QUICK FREIGHT ENTERPRISE</small><br>
	<small>15867 SW 147th LN</small><br>
	<small>MIAMI, FL 33196</small><br>
	<small>+1 786 208 9900</small>
</body>
</html>
