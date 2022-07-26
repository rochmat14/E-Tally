<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    private $controller = 'members_transaction_history';
    private $title = 'My Transaction History';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();

        $title = $this->title;

        return view('members.transaction_history.index',compact('user','title'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }
}
