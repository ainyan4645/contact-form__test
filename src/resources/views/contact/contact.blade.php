@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}" />
@endsection

@section('content')

<div class="form">
    <h2>Contact</h2>
    <form action="/confirm" method="post">
        @csrf
        <div>
            <label>お名前 <span>※</span></label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
            @error('last_name')
            <p class="error">{{ $message }}</p>
            @enderror
            @error('first_name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>性別 <span>※</span></label>
            <input type="radio" name="gender" value="1" {{ old('gender') == '男性' ? 'checked' : '' }}> 男性
            <input type="radio" name="gender" value="2" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性
            <input type="radio" name="gender" value="3" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他
            @error('gender')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>メールアドレス <span>※</span></label>
            <input type="text" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>電話番号 <span>※</span></label>
            <input type="text" name="tel1" value="{{ old('tel1') }}" size="4"> -
            <input type="text" name="tel2" value="{{ old('tel2') }}" size="4"> -
            <input type="text" name="tel3" value="{{ old('tel3') }}" size="4">
            @error('tel')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>住所 <span>※</span></label>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
            @error('address')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
        </div>

        <div>
            <label>お問い合わせの種類 <span>※</span></label>
            <select name="category_id">
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

        <div>
            <label>お問い合わせ内容 <span>※</span></label>
            <textarea name="detail" placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>
            @error('detail')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">確認画面</button>
    </form>
</div>
@endsection
