@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm">
    <h2>Confirm</h2>
    <form action="/thanks" method="post">
        @csrf
        <table>
            <tr>
                <th>お名前</th>
                <td>
                    <input type="text" name="name" value="{{ $contact['last_name'] }}　{{ ['first_name'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    <input type="text" name="content" value="{{ $contact['content'] }}" readonly />
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>
                    <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                </td>
            </tr>
        </table>

        <button>送信</button>
        <button>修正</button>
    </form>
</div>
@endsection