<html>

<head>
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

	<style>
		/* スタイルをここに書く */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
		}

		.header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 20px;
		}

		.logo {
			font-family: 'Pacifico', cursive;
			font-size: 100px;
			/* font-weight: bold; */
			color: #333333;
		}

		.nav {
			display: flex;
			list-style: none;
		}

		.nav-item {
			margin-left: 20px;
		}

		.nav-link {
			text-decoration: none;
			color: #333333;
		}

		.nav-link:hover {
			color: #ff0000;
		}

		.hero {
			height: 600px;
			background-image: url("./img/outside01.jpeg");
			background-size: cover;
			background-position: center;
		}

		.hero-content {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100%;
			color: #ffffff;
			-webkit-text-stroke: 1px #100e0e;
			text-stroke: 1px #0e0d0d;
		}

		.hero-title {
			font-size: 48px;
			font-weight: bold;
			margin-bottom: 20px;
		}

		.hero-subtitle {
			font-size: 24px;
			font-weight: bold;
			margin-bottom: 40px;
		}

		.hero-button {
			display: inline-block;
			padding: 15px 30px;
			border-radius: 10px;
			background-color: #ff0000;
			text-decoration: none;
			color: #ffffff;
		}

		.hero-button:hover {
			background-color: #cc0000;
		}

		/* モーダルCSS */
		/* .modal-container {
  		position: relative;
		}

		.modal-background {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		display: none;
		}

		.modal {
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background-color: #fff;
		padding: 20px;
		border-radius: 8px;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		display: none;
		} */
		/* ここまで */

	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<div class="logo">commode</div> 
			<!-- コモッド -->
			<ul class="nav">
				<li class="nav-item"><a href="#" class="nav-link">ホーム</a></li>
				<li class="nav-item"><a href="#" class="nav-link">カテゴリー</a></li>
				<li class="nav-item"><a href="#" class="nav-link">お気に入り</a></li>
				<li class="nav-item"><a href="login.html" class="nav-link">ログイン</a></li>
				<li class="nav-item"><a href="register.html" class="nav-link">登録</a></li>
			</ul>
		</div>
		<div class="hero">
			<div class="hero-content">
				<h1 class="hero-title">子供のおしゃれを管理しよう</h1>
				<p class="hero-subtitle"></p>
				<a href="login.html" class="hero-button">ログインして始める</a>
			</div>
		</div>
	</div>

				<!-- <div class="modal-container">
			<button id="modal-trigger">ログイン</button>
			<div class="modal-background"></div>
			<div class="modal"> -->
				<!-- ログインフォームのHTMLコードをここに追加 -->
				<!-- <form id="loginForm" method="post" action="login.php">
				<label for="email">メールアドレス:</label>
				<input type="email" id="email" name="email" required>

				<label for="password">パスワード:</label>
				<input type="password" id="password" name="password" required>

				<button type="submit">ログイン</button>
				</form>

			</div>
			</div>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
				var modalTrigger = document.getElementById("modal-trigger");
				var modalBackground = document.querySelector(".modal-background");
				var modal = document.querySelector(".modal");

				modalTrigger.addEventListener("click", function() {
					modalBackground.style.display = "block";
					modal.style.display = "block";
				});

				modalBackground.addEventListener("click", function() {
					modalBackground.style.display = "none";
					modal.style.display = "none";
				});
				});

			</script> -->
</body>

</html>