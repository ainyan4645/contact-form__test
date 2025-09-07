@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('navi')
@if (Auth::check())
<form class="form" action="{{ route('logout') }}" method="post">
    @csrf
    <button class="header-nav__button">logout</button>
</form>
@endif
@endsection

@section('content')

<main class="main">
    <h2 class="page-title">Admin</h2>

    <form class="search-box" method="GET" action="/search">
        <input class="search-box__keyword" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
        <div class="select-wrap">
            <select class="search-box__gender" name="gender">
                <option value="">性別</option>
                <option value="male" {{ request('gender')=='male' ? 'selected' : '' }}>男性</option>
                <option value="female" {{ request('gender')=='female' ? 'selected' : '' }}>女性</option>
                <option value="other" {{ request('gender')=='other' ? 'selected' : '' }}>その他</option>
            </select>
        </div>
        <div class="select-wrap">
            <select class="search-box__inquiry" name="inquiry">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->content }}" {{ request('inquiry')==$category->content ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="select-wrap">
            <input class="search-box__date" type="date" name="date">
        </div>
        <button type="submit" class="btn">検索</button>
        <button type="button" class="btn reset">リセット</button>
    </form>

    <div class="pagination">
        {{ $contacts->links() }}
        <!-- <a href="#">&lt;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">&gt;</a> -->
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
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @elseif($contact->gender == 3) その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button
                            class="btn detail"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-email="{{ $contact->email }}"
                            data-gender="{{ $contact->gender }}"
                            data-tel="{{ $contact->tel ?? '' }}"
                            data-address="{{ $contact->address ?? '' }}"
                            data-building="{{ $contact->building ?? '' }}"
                            data-category="{{ $contact->category->content }}"
                            data-content="{{ $contact->detail }}"
                        >
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="modal" class="modal">
            <div class="modal-content">
                <span id="modal-close" class="modal-close">&times;</span>
                <table class="modal-table">
                    <tr>
                        <th>お名前</th>
                        <td id="modal-name"></td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td id="modal-gender"></td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td id="modal-email"></td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td id="modal-tel"></td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td id="modal-address"></td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td id="modal-building"></td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td id="modal-category"></td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td id="modal-detail"></td>
                    </tr>
                </table>
                <form id="modal-delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete">削除</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
// リセットボタン
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".btn.reset").addEventListener("click", function() {
        // 検索ページにリダイレクト
        window.location.href = "/search";
    });
});

// モーダルウィンドウ
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const closeBtn = document.getElementById("modal-close");

    const nameField = document.getElementById("modal-name");
    const emailField = document.getElementById("modal-email");
    const genderField = document.getElementById("modal-gender");
    const telField = document.getElementById("modal-tel");
    const addressField = document.getElementById("modal-address");
    const buildingField = document.getElementById("modal-building");
    const categoryField = document.getElementById("modal-category");
    const detailField = document.getElementById("modal-detail");
    const deleteForm = document.getElementById("modal-delete-form");

    const genderMap = {
        1: "男性",
        2: "女性",
        3: "その他"
    };

    document.querySelectorAll(".btn.detail").forEach(btn => {
        btn.addEventListener("click", function() {
            nameField.textContent = this.dataset.name;
            emailField.textContent = this.dataset.email;
            genderField.textContent = genderMap[this.dataset.gender] || "未設定";
            telField.textContent = this.dataset.tel || "-";
            addressField.textContent = this.dataset.address || "-";
            buildingField.textContent = this.dataset.building || "-";
            categoryField.textContent = this.dataset.category;
            detailField.textContent = this.dataset.content.replace(/\\n/g, '\n');

            deleteForm.action = `/contacts/${this.dataset.id}`;

            modal.classList.add("show");
        });
    });

    closeBtn.addEventListener("click", () => modal.classList.remove("show"));
    modal.addEventListener("click", e => { if(e.target === modal) modal.classList.remove("show"); });
});
</script>

@endsection