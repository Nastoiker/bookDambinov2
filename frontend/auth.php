<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form</title>
	<link rel="stylesheet" href="assets/styles/auth.css">
</head>
<body>
	<form class="form" name="loginForm">
		<div class="input-form">
			<label for="email">Email address</label>
			<input
					type="email"
					class="form-control"
					id="email"
					aria-describedby="emailHelp"
					placeholder="Enter email"
					data-required="email"
					data-invalid-message="Please provide valid email example@example.com"
					required
			/>
		</div>
		<div class="input-form">
			<label for="password">Password</label>
			<input
					type="password"
					class="form-control"
					id="password"
					placeholder="Password"
					data-required="password"
					required
			/>
		</div>
		<button type="submit" class="">Submit</button>
	</form>
    <script src="assets/js/auth.js"></script>
</body>
</html>