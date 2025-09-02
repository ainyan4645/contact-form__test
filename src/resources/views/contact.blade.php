@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')

<div class="form">
    <h2>Contact</h2>
    <form action="/confirm" method="post">
        @csrf
        <div>
            <label>お名前 <span>※</span></label>
            <input type="text" name="last_name" placeholder="例: 山田" required>
            <input type="text" name="first_name" placeholder="例: 太郎" required>
        </div>

        <div>
            <label>性別 <span>※</span></label>
            <input type="radio" name="gender" value="男性" checked> 男性
            <input type="radio" name="gender" value="女性"> 女性
            <input type="radio" name="gender" value="その他"> その他
        </div>

        <div>
            <label>メールアドレス <span>※</span></label>
            <input type="email" name="email" placeholder="例: test@example.com" required>
        </div>

        <div>
            <label>電話番号 <span>※</span></label>
            <input type="text" name="tel1" size="4" required> -
            <input type="text" name="tel2" size="4" required> -
            <input type="text" name="tel3" size="4" required>
        </div>

        <div>
            <label>住所 <span>※</span></label>
            <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required>
        </div>

        <div>
            <label>建物名</label>
            <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101">
        </div>

        <div>
            <label>お問い合わせの種類 <span>※</span></label>
            <select name="category" required>
                <option value="">選択してください</option>
                <option value="商品について">商品について</option>
                <option value="配送について">配送について</option>
                <option value="交換・返品について">商品交換・返品について</option>
            </select>
        </div>

        <div>
            <label>お問い合わせ内容 <span>※</span></label>
            <textarea name="detail" placeholder="お問い合わせ内容をご記入ください" required></textarea>
        </div>

        <button type="submit">確認画面</button>
    </form>
</div>
@endsection
