@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('navi')
@if (Auth::check())
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header-nav__button">logout</button>
</form>
@endif
<!-- <a href="logout.html" class="header-link">logout</a> -->
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
        <button type="reset" class="btn reset">リセット</button>
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
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button 
                            class="btn detail"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-email="{{ $contact->email }}"
                            data-gender="{{ $contact->gender }}"
                            data-category="{{ $contact->category->content }}"
                            data-content="{{ $contact->content }}"
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
                <p><strong>名前：</strong><span id="modal-name"></span></p>
                <p><strong>メール：</strong><span id="modal-email"></span></p>
                <p><strong>性別：</strong><span id="modal-gender"></span></p>
                <p><strong>お問い合わせ種類：</strong><span id="modal-category"></span></p>
                <p><strong>内容：</strong><span id="modal-content"></span></p>
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
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const closeBtn = document.getElementById("modal-close");

    const nameField = document.getElementById("modal-name");
    const emailField = document.getElementById("modal-email");
    const genderField = document.getElementById("modal-gender");
    const categoryField = document.getElementById("modal-category");
    const contentField = document.getElementById("modal-content");
    const deleteForm = document.getElementById("modal-delete-form");

    document.querySelectorAll(".btn.detail").forEach(btn => {
        btn.addEventListener("click", function() {
            nameField.textContent = this.dataset.name;
            emailField.textContent = this.dataset.email;
            genderField.textContent = this.dataset.gender;
            categoryField.textContent = this.dataset.category;
            contentField.textContent = this.dataset.content;

            deleteForm.action = `/contacts/${this.dataset.id}`;

            modal.classList.add("show");
        });
    });

    closeBtn.addEventListener("click", () => modal.classList.remove("show"));
    modal.addEventListener("click", e => { if(e.target === modal) modal.classList.remove("show"); });
});
</script>

@endsection