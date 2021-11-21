<?php

//norint pildyti funkcionalumà, klases reikia uþvardinti taip (file type)_loader pvz: txt_loader, png_loader, jpg_loader.
interface loaderInterface {
    public function load();
    public function show();
}

class xml_loader implements loaderInterface {
    
    private $file;
    private $data;
    
    public function __construct(string $file) {
        $this->file = $file;
    }
    
    public function load() {
        //get file contents and save
        $this->data = new SimpleXMLElement($this->file);
  
    }
    
    public function show() {
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


class json_loader implements loaderInterface {
    private $file;
    private $data;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function load() {
        //get file contents and save
        $this->data = json_decode($this->file);
          
    }
    
    public function show() {
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

class csv_loader implements loaderInterface {
    private $file;
    private $data;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function load() {
        //reading csv file as a string and spliting the string into array by new lines
        $this->data = explode ("\r\n", $this->file);
        //removing first array line - collumn names and leaving only the data
        array_shift($this->data);
    }
    
    public function show() {
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
?>