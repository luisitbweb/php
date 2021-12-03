<?php

namespace www\PhpStudy\Integrating_PHP_Windows;

class UpdateOrders{
    protected $db;
    protected $stmt;
    // Variables bound to statement
    protected $sql_qty, $sql_discount, $sql_id;
    
    // Constructor sets database connection
    
    function __construct($db) {
        $this->db = $db;
    }
    /*
     * Read relevant data from the table and write it to HTML array.
     * @param int $id Number of SaleOrder
     */
    function getByHeader($id){
        $query = 'SELECT SalesOrderDetailID, OrderQty, UnitPriceDiscount '
                . 'FROM Sales.SalesOrderDetail '
                . 'WHERE SalesOrderID = ?';
        $params = array($id);
        $stmt = sqlsrv_query($this->db->handle, $query, $params);
        if($stmt === false){
            $this->db->exitWithError('Data query has failed.');
        }
        // Read individual result rows
        $table = array(array('ID', 'Amount', 'Discount'));
        while ($row = sqlsrv_fetch_array($stmt)){
            $table[] = array($row['SalesorderDetailID'], $row['OrderQty'], 
                $row['UnitPriceDiscount']);
        }
        if($row === false){
            $this->db->exitWithError('Retrieving data has failed.');
        }
        sqlsrv_free_stmt($stmt);
        return $table;
    }
    /*
     * Prepare update statement.
     */
    function prepare(){
        $query = 'UPDATE Sales.SalesOrderDetail '
                . 'SET OrderQty = ?, UnitPriceDiscount = ? '
                . 'WHERE SalesOrderDetailID = ?';
        /*
         * Parameters must be used as references (&$...)n.
         * This way all later changes to the variables are
         * Applied to the prepared T-SQL statement
         */
        $params = array(&$this->sql_qty, &$this->sql_discount, &$this->sql_id);
        // Prepare statement
        $this->stmt = sqlsrv_prepare($this->db->handle, $query, $params);
        if($this->stmt === false){
            $this->db->exitWithError('Statement preparation failed.');
        }
    }
    /*
     * Run prepared statement
     * The updated values are passed as parameters.
     */
    function update($id, $qty, $discount){
        /*
         * Variable update in applied to T-SQL statement,
         * because the variables are bound as references.
         */
        $this->sql_id       = $id;
        $this->sql_qty      = $qty;
        $this->sql_discount = $discount;
        if(sqlsrv_execute($this->stmt) === false){
            $this->db->exitWithError('Update failed.');
        }
    }
    function free(){
        sqlsrv_free_stmt($this->stmt);
    }
}