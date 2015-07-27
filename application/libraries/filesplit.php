<?php

class Filesplit {
    
    public function __construct()
    {
        $this->_source  = 'files.txt';
        $this->_path    = 'uploads/';
        $this->_lines   = 1000;
        
    }   
    
    function Getsource(){ 
        return $this->_source; 
    } 
     
    
    function Setsource($newValue){ 
        $this->_source = $newValue; 
    } 

    
    function Getlines(){ 
        return $this->_lines; 
    } 
     
    
    function Setlines($newValue){ 
        $this->_lines = $newValue; 
    } 

   
    function Getpath(){ 
        return $this->_path; 
    } 
     
   
    function Setpath($newValue){ 
        $this->_path = $newValue; 
    } 

    function configure($source = "",$path = "",$lines = ""){ 
        if ($source != "") { 
            $this->Setsource($source); 
        } 
        if ($path!="") { 
            $this->Setpath($path); 
        } 
        if ($lines!="") { 
            $this->Setlines($lines); 
        } 
    } 
     
     
   
    function run(){
        
        $return = array();
        
        $i=0;
        $total = 0;
        $total2 = 0;
        $j=1; 
        $date = date("m-d-y"); 

        $buffer1;
        $handle1 = @fopen ($this->Getsource(), "r"); 
        while (!feof ($handle1)) { 
            @$buffer1 .= @fgets($handle1, 4096); 
            @$total2++; 
        }
        $buffer;
        $ultimo = false;
         
        $handle = @fopen ($this->Getsource(), "r"); 
        while (!feof ($handle)) { 
            @$buffer .= @fgets($handle, 4096); 
            @$i++;
            $total++;      

            if($ultimo == true){

                  if($total == $total2){

                      $fname = $this->Getpath()."part.$date.$j.txt";
                      $return[] = $fname;
                       
                      
                      if (!$fhandle = @fopen($fname, 'w')) { 
                          print "Cannot open file ($fname)"; 
                          exit; 
                      } 

                      if (!@fwrite($fhandle, $buffer)) { 
                         print "Cannot write to file ($fname)"; 
                         exit; 
                      } 
                    
                      fclose($fhandle); 
                  }
            }      

            if ($i >= $this->Getlines()) { 

                  $fname = $this->Getpath()."part.$date.$j.txt";
                  $return[] = $fname;
                   
                  
                  if (!$fhandle = @fopen($fname, 'w')) { 
                      print "Cannot open file ($fname)"; 
                      exit; 
                  } 

                  if (!@fwrite($fhandle, $buffer)) { 
                     print "Cannot write to file ($fname)"; 
                     exit; 
                  } 
                  
                
                  fclose($fhandle); 

                  

                if ( ($total2 - ($i*$j)) < $this->Getlines() ){
                    $ultimo = true;
                }

                unset($buffer,$i);
                    
                $j++;           
            }
        }

        if($total2 < $this->Getlines()){
            copy($this->Getsource(), $this->Getpath()."part.$date.1.txt");
            $return[] =  $this->Getpath()."part.$date.1.txt";
        }

        
        fclose ($handle);

        
        
        return $return;
        
    }


} 