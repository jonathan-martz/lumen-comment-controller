<?php

namespace App\Http\Controllers;

use \http\Env\Response;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
    public function filter($connection, $filters){
        foreach($filters as $key => $filter){
            if(count($filter) === 3){
                $connection->where($filter[0],$filter[1],$filter[2]);
            }
        }
        return $connection;
    }

    public function orderBy($connection, $orderby){
        if(count($orderby) === 2){
            $connection->orderBy($orderby[0],$orderby[1]);
        }
        return $connection;
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function select(Request $request){
        $validation = $this->validate($request, [
            'filter' => 'array|required',
            'orderby' => 'array|required'
        ]);

        $connection = DB::table('comments');

        $filter = $request->input('filter');
        $orderby = $request->input('orderby');

        $connection = $this->filter($connection,$filter);
        $connection = $this->orderBy($connection,$orderby);

        $comments = $connection->get();

        $this->addResult('comments',$comments);
        $this->addMessage('success','All your Comments.');

        return $this->getResponse();
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function view(Request $request){
        $validation = $this->validate($request, [
            'id' => 'bail|required|integer'
        ]);

        $id = $request->input('id');

        $comment = DB::table('comments')
            ->where('id','=',$id);

        $count = $comment->count();

        if($count === 1){
            $this->addResult('comment',$comment->first());
            $this->addMessage('success','Your Comment.');
        }
        else{
            $this->addMessage('success','Comment doesnt exists.');
        }

        return $this->getResponse();
    }
}
