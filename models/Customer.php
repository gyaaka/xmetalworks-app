<?php
class Customer {
    private $conn;
    private $table_name = "customer";

    public $customer_id;
    public $name;
    public $contact_number;
    public $location;
    public $credit;
    public $date_of_entry;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        $query = "INSERT INTO ".$this->table_name." 
                SET name=:name, contact_number=:contact_number, 
                location=:location, credit=:credit, date_of_entry=:date_of_entry";
        
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->credit = htmlspecialchars(strip_tags($this->credit));
        $this->date_of_entry = htmlspecialchars(strip_tags($this->date_of_entry));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":contact_number", $this->contact_number);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":credit", $this->credit);
        $stmt->bindParam(":date_of_entry", $this->date_of_entry);
        
        return $stmt->execute();
    }
}
?>
