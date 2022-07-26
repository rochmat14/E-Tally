<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testimonial;
use App\Http\Requests\Backend\TestimonialRequest;
use App\Http\Requests\Backend\TestimonialEditRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    private $controller = 'testimonial';
    private $title = 'Data Testimonial';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.index')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }


    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [
            1=>'id', 
            2=>'name',
            3=>'subtitle',
            4=>'text',
            5=>'photo',
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Testimonial::select([
            'id',
            'name',
            'subtitle',
            'text',
            'photo',
        ])
        ->where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('photo', function ($row) {

                $photo  = "<img src='".url('images/testimonial').'/'.$row->photo."' style='width:200px;height:200px;'>";
                return $photo;
            })
            ->addColumn('editUrl', function ($row) {
                return $row->id;
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;

            })
            ->make();
    }

    public function save(TestimonialRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }



        $name = $request->get('name');
        $subtitle = $request->get('subtitle');
        $text = $request->get('text');


        //saving table
        $data = new Testimonial;
        $data->name = $name;
        $data->subtitle = $subtitle;
        $data->text = $text;

        if($request->photo){
            // upload logo bank
            $photo = $request->photo;
            $destinationPath = 'images/testimonial/';
            $filename = time().'.'.$request->photo->extension();  
            $request->photo->move($destinationPath, $filename);
            $data->photo = $filename;

        }

        $data->status = 1;
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));
    }

    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = Testimonial::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(TestimonialEditRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $name = $request->get('name');
        $subtitle = $request->get('subtitle');
        $text = $request->get('text');
    

        //update 
        $pk = Testimonial::find($id);
        $pk->name = $name;
        $pk->subtitle = $subtitle;
        $pk->text = $text;

        if($request->photo){
            // upload logo bank
            $photo = $request->photo;
            $destinationPath = 'images/testimonial/';
            $filename = time().'.'.$request->photo->extension();  
            $request->photo->move($destinationPath, $filename);
            $pk->photo = $filename;

        }


        $pk->updated_by =Auth::user()->id;
        $pk->save();
        echo json_encode(array("status" => TRUE));

    }

    public function delete(Request $request){
        if (!auth()->user()->can($this->controller.'-delete')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        //update  
        $pk = Testimonial::find($id);
        $pk->status = 0;
        $pk->updated_by =Auth::user()->id;
        $pk->save();


        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "success",
                    "message"=>"Success ! Deleted data"
                )
            );
        echo json_encode($result);
    }
}
