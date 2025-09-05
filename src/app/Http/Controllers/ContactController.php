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
        return view('contact.contact');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();
        return view('contact.confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->validated();
        Contact::create($contact);
        return view('contact.thanks');
    }

    // 管理画面(初期表示)
    public function admin()
    {
        $contacts = Contact::with('category')->Paginate(7); // リレーションも一緒に取得
        $categories = Category::all(); // カテゴリ一覧を渡す

    return view('admin', compact('contacts' 'categories'));
    }

    // 検索処理
    public function search(Request $request)
    {
        $query = Contact::with('category');

        // 名前検索（姓・名・フルネーム）
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) like ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%"); // メールも同じ欄で検索
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // お問い合わせ種類検索
        if ($request->filled('inquiry')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('content', $request->input('inquiry'));
            });
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // 7件ずつ表示 + ページネーション保持
        $contacts = $query->paginate(7)->appends($request->all());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    // 削除機能
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.admin')->with('success', '削除しました');
    }
}