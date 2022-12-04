<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form</title>
	<link rel="stylesheet" href="assets/styles/auth.css">
</head>
<style>
    html, body {

        background-image: linear-gradient(to bottom right, #a1e89b 0%, #daaeae 100%);
        font-family: 'Lato', sans-serif;
        height: 100%;
        width: auto;
        margin:0;
    }
    .btn_auth {
        padding: 40px;
    }
</style>
<body>
<img onclick="window.location.href =`./index.php`" src="assets/src/icons/arrow_more.svg" autofocus style="transform: rotate(180deg)" alt="">
	<form class="form" name="loginForm">
		<div class="input-form">
			<label for="email">email</label>
			<input
                    required
					type="email"
					class="form-control"
					id="email"
                    name="email"
					aria-describedby="emailHelp"
					placeholder="Enter email"
					data-required="email"
					data-invalid-message="Please provide valid email example@example.com"
			/>
		</div>
		<div class="input-form">
			<label for="password">пароль</label>
			<input
                    required
					type="password"
					class="form-control"
					id="password"
                    name="password"
					placeholder="Password"
					data-required="password"
			/>
		</div>
		<button type="submit" id="btn_submit" >Авторизоваться</button>
	</form>
    <p id="response_message"></p>
    <script src="assets/js/auth.js"></script>
</body>
</html>