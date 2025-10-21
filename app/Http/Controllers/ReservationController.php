<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'book.author'])
            ->orderBy('borrow_date', 'desc')
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function store(Request $request, Book $book)
    {
        if ($book->available_copies <= 0) {
            return redirect()->back()->with('error', 'عذراً، لا توجد نسخ متاحة من هذا الكتاب للحجز حالياً.');
        }

        $existingReservation = Reservation::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->first();

        if ($existingReservation) {
            return redirect()->back()->with('error', 'لديك بالفعل حجز نشط لهذا الكتاب.');
        }

        try {
            DB::transaction(function () use ($book) {

                $book->decrement('available_copies');

                Reservation::create([
                    'user_id' => Auth::id(),
                    'book_id' => $book->id,
                    'borrow_date' => now()->toDateString(),
                    // ✅ التصحيح: تم تغيير المدة من أسبوعين إلى أسبوع واحد
                    'return_date' => now()->addWeeks(1)->toDateString(),
                    'status' => 'borrowed',
                ]);
            });

            return redirect()->route('reservations.my')
                ->with('success', 'تم حجز الكتاب بنجاح. يرجى استلامه قبل تاريخ الإرجاع المتوقع.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء الحجز. يرجى المحاولة مرة أخرى.');
        }
    }

    public function myReservations()
    {
        $reservations = Auth::user()->reservations()
            ->with('book.author')
            ->orderBy('borrow_date', 'desc')
            ->paginate(10);

        return view('admin.reservations.my-reservations', compact('reservations'));
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'borrowed') {
            return redirect()->back()->with('error', 'غير مصرح لك بإلغاء هذا الحجز.');
        }

        try {
            DB::transaction(function () use ($reservation) {
                $reservation->book->increment('available_copies');
                $reservation->delete();
            });

            return redirect()->route('reservations.my')->with('success', 'تم إلغاء الحجز بنجاح وإتاحة نسخة الكتاب.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إلغاء الحجز.');
        }
    }

    public function markAsReturned(Reservation $reservation)
    {
        if ($reservation->status !== 'borrowed') {
            return redirect()->back()->with('error', 'الحجز مسجل بالفعل على أنه مُعاد أو مُلغى.');
        }

        try {
            DB::transaction(function () use ($reservation) {
                $reservation->book->increment('available_copies');

                $reservation->update([
                    'status' => 'returned',
                    'returned_at' => now(),
                ]);
            });

            return redirect()->route('admin.reservations.index')->with('success', 'تم تسجيل إرجاع الكتاب بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تسجيل الإرجاع.');
        }
    }
}
