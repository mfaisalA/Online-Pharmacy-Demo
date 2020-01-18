<html lang="EN">
	<head>
		<meta charset="utf-8">
		<style>
			.login_holder {
				padding:3px;
				margin-left:auto;
				margin-right:auto;
				margin-top:10%;
				display:table;
				border:solid 1px #cccccc;
				border-width: thin;
			}
			input[type='submit'] {
				float:right;
			}
		</style>
	</head>
	<body>
	<div class="login_holder">
		<form method="post" action="inc/login.php">
			<label for="username">Username:</label><input type="text" name="username"/><br/>
			<label for="password">Password:</label><input type="password" name="password"/><br/>
			<input type="submit" value="Submit" name=""/>
		<form>
	</div>	
	</body>
</html>