@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('navi')
<a href="register.html" class="header-link">register</a>
@endsection

@section('content')

<main class="main">
    <h2 class="page-title">Login</h2>
    <div class="form-box">
        <form action="/login" method="post">
            @csrf
            <label for="email">メールアドレス</label>
            <input type="email" id="email" placeholder="例: test@example.com">

            <label for="password">パスワード</label>
            <input type="password" id="password" placeholder="例: coachtech1106">

            <button type="submit" class="btn">ログイン</button>
        </form>
    </div>
</main>
@endsection