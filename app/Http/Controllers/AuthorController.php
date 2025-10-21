<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AuthorStoreRequest;
use App\Http\Requests\Admin\AuthorUpdateRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderBy('name')->paginate(10);

        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(AuthorStoreRequest $request)
    {
        Author::create($request->validated());

        return redirect()->route('admin.authors.index')
            ->with('success', 'تم إضافة المؤلف بنجاح.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(AuthorUpdateRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('admin.authors.index')
            ->with('success', 'تم تحديث بيانات المؤلف بنجاح.');
    }

    public function destroy(Author $author)
    {
        try {
            $author->delete();
            return redirect()->route('admin.authors.index')->with('success', 'تم حذف المؤلف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.authors.index')
                ->with('error', 'لا يمكن حذف هذا المؤلف لأنه مرتبط بكتاب واحد على الأقل. يرجى حذف كتبه أولاً.');
        }
    }
}
