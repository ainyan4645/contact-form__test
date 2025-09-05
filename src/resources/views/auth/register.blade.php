@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('navi')
<a href="logout.html" class="header-link">login</a>
@endsection

@section('content')

<main class="main">
    <h2 class="page-title">Register</h2>
    <div class="form-box">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <label for="name">お名前</label>
            <input type="text" name="name" id="name" placeholder="例: 山田　太郎" required>

            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="例: test@example.com" required>

            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="例: coachtech1106" required>

            <button type="submit" class="btn">登録</button>
        </form>
    </div>
</main>
@endsection