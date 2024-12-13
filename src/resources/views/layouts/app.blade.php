<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mogitate</title>
	<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	@yield('css')
</head>

<body>
	<header class="header">
		<div class="container">
        <a class="header__logo" href="/products">mogitate</a>
        </div>
    </header>
	<main>
		@yield('content')
	</main>
</body>
</html>