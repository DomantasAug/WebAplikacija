<?php

//norint pildyti funkcionalumà, klases reikia uþvardinti taip (file type)_loader pvz: txt_loader, png_loader, jpg_loader.
interface loaderInterface {
    public function load();
    public function show();
}

class xml_loader implements loaderInterface {
    
    private $file;
    private $xml;
    
    public function __construct(string $file) {
        $this->file = $file;
    }
    
    public function load() {
        //get file contents and save
        $this->xml = new SimpleXMLElement($this->file);

         
    }
    
    public function show() {
        echo "
        <table>
            <thead>
            <th>First name</th>
            <th>Age</th>
            <th>Gender</th>
            </thead>";
        
        echo "<tbody>"; //
        //a loop to render items from xml file to webpage
        foreach ($this->xml->item as $item) {
            echo "<tr>";
            echo "<td>".$item->first_name."</td>";
            echo "<td>".$item->age."</td>";
            echo "<td>".$item->gender."</td>";
            echo "</tr>";
            
        }
                
        echo "</table>";             
    }
    
}


class json_loader implements loaderInterface {
    private $file;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function load() {
        //get file contents and save
          
    }
    
    public function show() {
        
    }
}

class csv_loader implements loaderInterface {
    private $file;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function load() {
        //get file contents and save
        
    }
    
    public function show() {
        
    }
}
?>