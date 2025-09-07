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
                    {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @php
                    $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'];
                    @endphp

                    {{ $genderText[$contact['gender']] }}
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ $contact['email'] }}
                    <input type="hidden" name="email" value="{{ $contact['email'] }}">
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    {{ $contact['tel'] }}
                    <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    {{ $contact['address'] }}
                    <input type="hidden" name="address" value="{{ $contact['address'] }}">
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    {{ $contact['building'] }}
                    <input type="hidden" name="building" value="{{ $contact['building'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    {{ $contact['category_name'] }}
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>
                    {{ $contact['detail'] }}
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                </td>
            </tr>
        </table>

        <button type="submit" class="button-submit" >送信</button>
        <button type="button" class="button-reset" onclick="window.location='{{ url('/') }}'">修正</button>
    </form>
</div>
@endsection