<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // 未ログインユーザーは自動でログイン画面にリダイレクト
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ミドルウェアで会員認証済みのユーザのみ
    // 管理画面(初期表示)
    public function index()
    {
        $contacts = Contact::with('category')->Paginate(7); // リレーションも一緒に取得
        $categories = Category::all(); // カテゴリ一覧を渡す

    return view('admin', compact('contacts', 'categories'));
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
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) like ?", ["%{$keyword}%"])
                    ->orWhere('email', 'like', "%{$keyword}%"); // メールも同じ欄で検索
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $genderMap = [
                'male' => 1,
                'female' => 2,
                'other' => 3
            ];
            $dbGender = $genderMap[$request->gender] ?? null;
            if ($dbGender) {
                $query->where('gender', $dbGender);
            }
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
