@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('navi')
<a href="{{ route('login') }}" class="header-link">login</a>
@endsection

@section('content')

<main class="main">
    <h2 class="page-title">Register</h2>
    <div class="form-box">
        <form action="{{ route('register.post') }}" method="post">
            @csrf
            <label for="name">お名前</label>
            <div class="form-box__input__inner">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田　太郎">
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <label for="email">メールアドレス</label>
            <div class="form-box__input__inner">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <label for="password">パスワード</label>
            <div class="form-box__input__inner">
                <input type="password" name="password" placeholder="例: coachtech1106">
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">登録</button>
        </form>
    </div>
</main>
@endsection