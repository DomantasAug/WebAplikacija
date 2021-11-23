<?php

/*
 * If it is required to add support for a new file type, name a class using file extension: 
 * (file extension)_loader, like this: txt_loader, doc_loader.
 * 
*/
interface loaderInterface {
    public function load();
    public function show();
}

class xml_loader implements loaderInterface {
    
    private $file;
    private $data;
    private $validFile = true;
    
    public function __construct(string $file) {
        $this->file = $file;
    }
    
    public function load() {
        //check file contents and save
        try {
            //parsing loaded xml file
            $this->data = new SimpleXMLElement($this->file); 
        } catch (Exception $e) {
            echo "Bad xml file loaded.";
            $this->validFile = false;
        }
    }
    
    public function show() {
        if ($this->validFile == true) {
            echo "
            <table><thead>
                <th>First name</th>
                <th>Age</th>
                <th>Gender</th>
            </thead>";
            
            echo "<tbody>"; //
            //a loop to render items from xml file to webpage
            foreach ($this->data->item as $item) {
                echo "<tr>";
                echo "<td>".$item->first_name."</td>";
                echo "<td>".$item->age."</td>";
                echo "<td>".$item->gender."</td>";
                echo "</tr>";
            }
                    
            echo "</tbody></table>";
        }                  
    }   
}


class json_loader implements loaderInterface {
    private $file;
    private $data;
    private $validFile = true;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function load() {
        //get file contents, check the file and save into variable
       $this->data = json_decode($this->file);
       
       //checking if json decode failed
       if ($this->data == NULL) {
           echo "Bad json file loaded.";
           $this->validFile = false;
       }      
    }
    
    public function show() {
        if ($this->validFile == true) {
            echo "
            <table><thead>
                <th>First name</th>
                <th>Age</th>
                <th>Gender</th>
            </thead>";
            
            echo "<tbody>"; 
            foreach ($this->data as $item)
            {
                echo "<tr>";
                echo "<td>".$item->first_name."</td>";
                echo "<td>".$item->age."</td>";
                echo "<td>".$item->gender."</td>";
                echo "</tr>";
                
            }
            echo "</tbody></table>";
        }    
    }
}

class csv_loader implements loaderInterface {
    private $file;
    private $data;
    private $validFile = true;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function load() {

        //reading csv file as a string and spliting the string into array by new lines
        $this->data = explode ("\r\n", $this->file);
        //removing first array line - collumn names and leaving only the data
        array_shift($this->data);
        
        //checking if the excel file has >= 1 lines of data, if not excel file is empty 
        if (count($this->data) < 1) {
            $this->validFile = false;
            echo "Empty csv file loaded.";
        }
    }
    
    public function show() {
        if ($this->validFile == true) {
            echo "
            <table><thead>
                <th>First name</th>
                <th>Age</th>
                <th>Gender</th>
            </thead>";
            
            echo "<tbody>";
            foreach($this->data as $line){ // Loop over each line
                $column = explode(",", $line); // split the line in 'columns'
                echo "<tr>";
                echo "<td>".$column[0]."</td>";
                echo "<td>".$column[1]."</td>";
                echo "<td>".$column[2]."</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }     
    }
}

?>