<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HomeBudget;
use App\Models\Category;


class HomebudgetController extends Controller
{
  /**
        * コンストラクタ
        *
        * @return void
        */
        public function __construct()
        {
            $this->middleware('auth');
        }
        
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
      $categories = Category::all();   
       $homebudgets = HomeBudget::with('category')->orderBy('date', 'desc')->paginate(5); 
        $income = HomeBudget::where('category_id', 6)->sum('price');
        $payment = HomeBudget::where('category_id', '!=', 6)->sum('price');
       return view('homebudget.index', compact('categories', 'homebudgets', 'income', 'payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /*$validated = $request->validate([
        'title' => 'requied|unique:posts|max:255',
        'body' => 'required',
        'price' => 'required|numeric',
       ]);*/

       

       $validated = $request->validate([
        'date' => 'required|date',
        'category' => 'required|numeric',
        'price' => 'required|numeric',
       ]);

       $result = HomeBudget::create([
        'date' => $request->date,
        'category_id' => $request->category,
        'price' => $request->price       
       ]);

       if (!empty($result)){
         session() -> flash('flash_message', '支出を登録しました');
       } else {
        session() -> flash('flash_error_message', '支出を登録できませんでした');
       }
       return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $categories = Category::all();  
      $homebudget =HomeBudget::find($id);
      return view('homebudget.edit', compact('homebudget','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
           ]);
    
           $hasDate = HomeBudget::where('id', '=', $request->id);
       if($hasDate->exists()) {
            $hasDate->update([
                'date' => $request->date,
                'category_id' => $request->category,
                'price' => $request->price 
            ]);
            session() -> flash('flash_message', '支出を登録しました');
          } else {
            session() -> flash('flash_error_message', '支出を登録できませんでした');
          }


          /* if (!empty($result)){
             session() -> flash('flash_message', '支出を登録しました');
           } else {
            session() -> flash('flash_error_message', '支出を登録できませんでした');
           }*/
           return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $homebudget = HomeBudget::find($id);
        $homebudget->delete();
        session()->flash('flash_message', '支出を削除しました');
        return redirect('/');
    }
}

