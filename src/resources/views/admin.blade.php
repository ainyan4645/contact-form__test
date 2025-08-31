@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('navi')
<a href="logout.html" class="header-link">logout</a>
@endsection

@section('content')

<main class="main">
    <h2 class="page-title">Admin</h2>

    <form class="search-box" method="GET" action="/search">
        <input class="search-box__keyword" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
        <div class="select-wrap">
            <select class="search-box__gender" name="gender">
                <option value="">性別</option>
                <option value="male">男性</option>
                <option value="female">女性</option>
            </select>
        </div>
        <div class="select-wrap">
            <select class="search-box__inquiry" name="inquiry">
                <option value="">お問い合わせの種類</option>
                <option value="support">サポート</option>
                <option value="sales">営業</option>
            </select>
        </div>
        <div class="select-wrap">
            <input class="search-box__date" type="date" name="date">
        </div>
        <button type="submit" class="btn">検索</button>
        <button type="reset" class="btn reset">リセット</button>
    </form>

    <div class="pagination">
        <a href="#">&lt;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">&gt;</a>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>山田　太郎</td>
                    <td>男性</td>
                    <td>test@example.com</td>
                    <td>商品の交換について</td>
                    <td><label for="modal-toggle-1" class="btn detail">詳細</label></td>
                </tr>
                <!-- 繰り返しデータ -->
            </tbody>
        </table>
    </div>
</main>
@endsection