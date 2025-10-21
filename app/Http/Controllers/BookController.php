<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\Admin\BookStoreRequest;
use App\Http\Requests\Admin\BookUpdateRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(10);

        return view('admin.books.index', compact('books'));
    }
    public function dashIndex()
    {
        $books = Book::where('available_copies', '>', 0)
            ->with('author')
            ->paginate(8);

        return view('dashboard', compact('books'));
    }

    public function create()
    {
        $authors = Author::select('id', 'name')->orderBy('name')->get();

        return view('admin.books.create', compact('authors'));
    }

    public function store(BookStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['available_copies'] = $data['total_copies'];
        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'تم إضافة الكتاب والمخزون بنجاح.');
    }

    public function show(Book $book)
    {
        $book->load('author');

        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::select('id', 'name')->orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function update(BookUpdateRequest $request, Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'تم تحديث بيانات الكتاب بنجاح.');
    }

    public function destroy(Book $book)
    {
        try {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $book->delete();

            return redirect()->route('admin.books.index')
                ->with('success', 'تم حذف الكتاب من المخزون بنجاح.');
        } catch (\Exception $e) {
            return redirect()->route('admin.books.index')
                ->with('error', 'فشل حذف الكتاب. تأكد من عدم وجود حجوزات نشطة مرتبطة به.');
        }
    }
}
