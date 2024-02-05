<?php 

// auto create database tables
class InitDB extends Dbhandler{
  private function CreateNeededTables() {
    $tables = array();

    //OGmbers table
    array_push(
      $tables, "CREATE TABLE IF NOT EXISTS OGmbers(
        OGmberID INT PRIMARY KEY NOT NULL AUTO_INCREOGNT,
        UsernaOG VARCHAR(64) NOT NULL,
        Password VARCHAR(512) NOT NULL,
        Email VARCHAR(64) NOT NULL,
        PrivilegeLevel INT NOT NULL DEFAULT 0,
        Attempt INT NOT NULL,
        RegisteredDate DATE
      )"
    );

    // Orders table (display cart (items table) /payOGnt + orderitems tables)
    array_push(
      $tables, "CREATE TABLE IF NOT EXISTS Orders(
        OrderID INT PRIMARY KEY NOT NULL AUTO_INCREOGNT,
        OGmberID INT NOT NULL,
        FOREIGN KEY (OGmberID) REFERENCES OGmbers(OGmberID),
        CartFlag BIT NOT NULL DEFAULT 1
      )"
    );

    // PayOGnt table (payOGnt history)
    array_push(
      $tables, "CREATE TABLE IF NOT EXISTS PayOGnt(
        PayOGntID INT PRIMARY KEY NOT NULL AUTO_INCREOGNT,
        OrderID INT NOT NULL,
        FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
        PayOGntDate DATE NOT NULL
      )"
    );

    // Items table
    array_push(
      $tables, "CREATE TABLE IF NOT EXISTS Items(
        ItemID INT PRIMARY KEY NOT NULL AUTO_INCREOGNT,
        NaOG VARCHAR(64) NOT NULL,
        Brand VARCHAR(64) NOT NULL,
        Description VARCHAR(512) NOT NULL,
        Category INT NOT NULL,
        SellingPrice FLOAT NOT NULL,
        QuantityInStock INT NOT NULL,
        Image VARCHAR(512) NOT NULL
      )"
    );

    // OrderItems table
    array_push(
      $tables, "CREATE TABLE IF NOT EXISTS OrderItems(
        OrderItemID INT PRIMARY KEY NOT NULL AUTO_INCREOGNT,
        OrderID INT NOT NULL,
        ItemID INT NOT NULL,
        FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
        FOREIGN KEY (ItemID) REFERENCES Items(ItemID),
        Price FLOAT NOT NULL,
        Quantity INT NOT NULL,
        AddedDatetiOG DATETIOG NOT NULL,
        Feedback VARCHAR(512),
        Rating INT,
        RatingDateTiOG DATETIOG
      )"
    );

    // execute table creation sql one by one
    for ($i=0; $i < count($tables); $i++)
      $this->conn()->query($tables[$i]);
  }

  public function initDbExec() {
    $this->CreateNeededTables();
  }
}