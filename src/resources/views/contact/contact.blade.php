@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}" />
@endsection

@section('content')

<div class="form">
    <h2>Contact</h2>
    <form action="/confirm" method="post">
        @csrf
        <div class="contact__content">
            <label>お名前 <span>※</span></label>
            <div class="contact__inner">
                <input class="contact__last-name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
                @error('last_name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="contact__inner">
                <input class="contact__first-name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
                @error('first_name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="contact__content">
            <label>性別 <span>※</span></label>
            <div class="contact__inner">
                <div class="contact__radio__inner">
                    <input class="contact__gender" type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性
                </div>
                <div class="contact__radio__inner">
                    <input class="contact__gender" type="radio" name="gender" value="2" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性
                </div>
                <div class="contact__radio__inner">
                    <input class="contact__gender" type="radio" name="gender" value="3" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他
                </div>
                @error('gender')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="contact__content">
            <label>メールアドレス <span>※</span></label>
            <div class="contact__inner">
                <input class="contact__email" type="text" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="contact__content">
            <label>電話番号 <span>※</span></label>
            <div class="contact__inner">
                <input class="contact__tel" type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080" size="4"> -
                <input class="contact__tel" type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234" size="4"> -
                <input class="contact__tel" type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678" size="4">
                @error('tel')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="contact__content">
            <label>住所 <span>※</span></label>
            <div class="contact__inner">
                <input class="contact__address" type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                @error('address')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="contact__content">
            <label>建物名</label>
            <input class="contact__building" type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
        </div>

        <div class="contact__content">
            <label>お問い合わせの種類 <span>※</span></label>
            <div class="contact__inner select-wrap">
                <select class="contact__category" name="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="contact__content">
            <label>お問い合わせ内容 <span>※</span></label>
            <div class="contact__inner">
                <textarea class="contact__detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                @error('detail')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit">確認画面</button>
    </form>
</div>
@endsection
