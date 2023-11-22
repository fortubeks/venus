<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\RoomReservationStoreRequest;
use App\Models\Guest;
use App\Models\RoomReservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomReservation $model)
    {
        return view('pages.expenses.index', ['expenses' => $model->orderBy('created_at','desc')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $room_no = $request->room;
        return view('pages.room-reservations.create')->with('room_no',$room_no);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomReservationStoreRequest $request)
    {   
        $request->merge(['hotel_id' => auth()->user()->hotel_id,'user_id' => auth()->user()->id]);
        $guest = session('guest');
        if($guest == null){
            $request->validate([
                'first_name' => 'required|string|max:255',
                'email' => ['required_if:phone,null', Rule::unique('guests')->whereNot('email',null)->where('hotel_id',auth()->user()->hotel_id) ],
                'phone' => ['required_if:email,null', Rule::unique('guests')->whereNot('phone',null)->where('hotel_id',auth()->user()->hotel_id) ],
                'address' => 'nullable|string|max:255'
            ]);
            $guest = Guest::create($request->all());
        }
        $request->merge(['guest_id' => $guest->id]);
        foreach($request->room as $room){
            //confirm that the room is available on the selected dates & they have not selected same room twice
            //if it is not then return a message with the room number
        }
        foreach($request->room as $key => $room){
            //save reservation
            $request->merge(['room_id' => $room]);
            $request->merge(['rate' => $request->rate[$key]]);
            $reservation = RoomReservation::create($request->all());
        }
        
        return redirect('/')->with('success','Reservation added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomReservation  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(RoomReservation $expense)
    {
        return view('pages.expenses.show')->with('expense',$expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomReservation  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomReservation $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomReservation  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomReservation $expense)
    {
        $amount = 0;
        foreach($request->amount as $_amount){
            $amount += $_amount;
        }
        foreach($request->new_item_amount as $_amount_){
            $amount += $_amount_;
        }
        $expense->update(
        ['category_id' => $request->category_id,
        'expense_date' => $request->expense_date,
        'supplier_id' => $request->supplier_id,
        'amount' => $amount,
        'note' => $request->note
        ]);
        foreach($request->item_id as $key => $item_id){
            $expense_item = ExpenseExpenseItem::find($item_id);
            
            $expense_item->update([
                'qty' => $request->qty[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
                'unit_qty' => $request->unit_qty[$key]
            ]);
        }

        foreach($request->new_item as $_key => $new_item){
            if($request->new_item_description[$_key] === null){
                continue;
            }
            
            $item = ExpenseItem::where('expense_category_id',$request->category_id)->where('name',$request->new_item_description[$_key])->first();
            if($item === null){
                $item = ExpenseItem::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $request->new_item_description[$_key],
                    'expense_category_id' => $request->category_id
                ]);
            }
            
            ExpenseExpenseItem::create([
                'expense_id' => $expense->id,
                'expense_item_id' => $item->id,
                'hotel_id' => auth()->user()->hotel_id,
                'qty' => $request->new_item_qty[$_key],
                'rate' => $request->new_item_rate[$_key],
                'amount' => $request->new_item_amount[$_key],
                'unit_qty' => $request->new_item_unit_qty[$_key]
            ]);
        }

        return redirect('expenses/'.$expense->id)->with('success','Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //delete expense items  
        foreach($expense->items as $item){
            $item->delete();
        }
        //delete payments
        foreach($expense->payments as $payment){
            $payment->delete();
        }
        //then delete the expense
        $expense->delete();
        return redirect('expenses')->with('success','Expense deleted successfully');
    }

    public function filterExpenses(Request $request){
        $_expenses = Expense::whereBetween('created_at', [$request->filter_from, $request->filter_to]);
        $expenses = $_expenses->paginate(15)->appends([
            'filter_from' => request('filter_from'),
            'filter_to' => request('filter_to'),
            ]);
        $expenses_sum = $_expenses->sum('amount');
        $expenses_count = $_expenses->count();
        return view('expenses.index')->with(compact('expenses','expenses_count','expenses_sum'));
    }
}
