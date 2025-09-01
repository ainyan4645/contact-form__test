@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm">
    <h2>Confirm</h2>
    <form>
        <table>
            <tr><th>お名前</th><td>input</td></tr>
            <tr><th>性別</th><td>input</td></tr>
            <tr><th>メールアドレス</th><td>input</td></tr>
            <tr><th>電話番号</th><td>input</td></tr>
            <tr><th>住所</th><td>input</td></tr>
            <tr><th>建物名</th><td></td></tr>
            <tr><th>お問い合わせの種類</th><td>category</td></tr>
            <tr><th>お問い合わせ内容</th><td>detail</td></tr>
        </table>

        <button>送信</button>
        <button>修正</button>
    </form>
</div>
@endsection