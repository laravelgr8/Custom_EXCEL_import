use File;

public function save(Request $request){
        
        if($file=$request->has('excel')){
            $file=$request->file('excel');
            $filename=time()."-".$file->getClientOriginalName();
            $file->move(public_path('excel'),$filename);
        }
        $csvFile = fopen(public_path('excel/'.$filename), 'r');
        fgetcsv($csvFile);
        while(($line = fgetcsv($csvFile)) !== FALSE){
            $name   = $line[0];
            $mobile  = $line[1];
            $age  = $line[2];
            DB::table('records')->insert([
                "name"=>$name,
                "mobile"=>$mobile,
                "age"=>$age
            ]);
        }

        fclose($csvFile);
    }
