<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UpdateAssigned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $users = User::all();
        $first_id = 1;
        $second_id = $first_id+1;
        foreach($users as $user){
           if($user->id>5)
            {
             //--
             $newuser = User::find($user->id);
             $newuser->assigned = [$first_id,$second_id];
             $newuser->save();
             //-- 
             $user1 = User::find($first_id);
             $value1 = ($user1->assigned==NULL)?[]:$user1->assigned;
             $user1->assigned=array_merge($value1,[$user->id]);               
             $user1->save();

             $user2 = User::find($second_id);
                $value2 = ($user2->assigned==NULL)?[]:$user2->assigned;
                $user2->assigned=array_merge($value2,[$user->id]);
             $user2->save();
              if($first_id<4)
              {
               $first_id+=2;
               $second_id = $first_id+1;
               if($first_id==5)
               {
                $second_id =1;
               }
               continue;
              }
               if($second_id==1)
                {
                  $first_id=2;
                  $second_id=3;
                }
                if($second_id==5)
                {
                  $first_id=1;
                  $second_id=2;
                }
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        $users = User::all();
        foreach($users as $user){
            $newuser = User::find($user->id);
            $newuser->assigned = NULL;
            $newuser->save();
        }

    }
}
