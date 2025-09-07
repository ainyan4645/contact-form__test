<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // お問い合わせフォーム
    public function contact()
    {
        $categories = \App\Models\Category::all();
        return view('contact.contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $request->flash(); // 入力内容をセッションに保持(修正ボタンで戻るため)

        $contact = $request->validated(); // バリデーション済みの値を取得

        // 電話番号を結合
        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        // category_id からカテゴリ名を取得して新しいキーに格納
        $contact['category_name'] = \App\Models\Category::find($contact['category_id'])->content;

        return view('contact.confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        Contact::create($request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ]));

        // 入力値をセッションから削除（リセット用）
        $request->session()->forget('_old_input');

        return view('contact.thanks');
    }
}