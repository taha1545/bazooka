<?php 
 
  namespace App\Filters;

  use Illuminate\Http\Request;

  class apifilter {
   
     protected $safeParms=[];   // for each name => eq , bt , lt 


     protected $columnMap=[];   // food_id  => food


     protected $operatorMap=[];  // eq => ==



     public function transform(Request $request){

          $eloQuery=[];
          foreach ($this->safeParms as $parm => $opreators){
        
        $query = $request->query($parm);

        if(!isset($query)){
           continue;
             }

            $column=$this->columnMap[$parm] ?? $parm;

                
               foreach($opreators as $opreator){
                  if (isset($query[$opreator])){
                     $eloQuery[]=[$column,$this->operatorMap[$opreator],$query[$opreator]];
                  }

               }}
            return $eloQuery;
            }}