<?php

class DB
{
    /**
     * global variables
     */
    public $dbhost 	= 'localhost';            			#  default database host
    public $dblogin = 'sstt_usr';               		#  database login name
    public $dbpass 	= 'Sstt2015';              			#  database login password
    public $dbname 	= 'servicio_tecnico';				#  database name
    public $dblink;                          			#  database link identifier
    public $queryid;                         			#  database query identifier
    public $error = array();                 			#  storage for error messages
    public $record = array();               			#  database query record identifier
    public $totalrecords;                   			#  the total number of records received from a select statement
    public $last_insert_id;                				#  last incremented value of the primary key
    public $previd = 0;                   			   	#  previus record id. [for navigating through the db]
    public $transactions_capable = false; 			   	#  does the server support transactions?
    public $begin_work = false;            				#  sentinel to keep track of active transactions

    /**
     * get and set type methods for retrieving properties.
     */

    function get_dbhost()
    {
        return $this->dbhost;

    } #  end function

    function get_dblogin()
    {
        return $this->dblogin;

    } #  end function

    function get_dbpass()
    {
        return $this->dbpass;

    } #  end function

    function get_dbname()
    {
        return $this->dbname;

    } #  end function

    function set_dbhost($value)
    {
        return $this->dbhost = $value;

    } #  end function

    function set_dblogin($value)
    {
        return $this->dblogin = $value;

    } #  end function

    function set_dbpass($value)
    {
        return $this->dbpass = $value;

    } #  end function

    function set_dbname($value)
    {
        return $this->dbname = $value;

    } #  end function

    function get_errors()
    {
        return $this->error;

    } #  end function

    /**
     * End of the Get and Set methods
     *# **
     * Constructor
     *
     * @param      String $dblogin, String $dbpass, String $dbname
     * @return     void
     * @access     public
     *# * function DB($dblogin, $dbpass, $dbname, $dbhost = null)
    {

	   
        $this->set_dblogin($dblogin);
        $this->set_dbpass($dbpass);
        $this->set_dbname($dbname);

        if ($dbhost != null) {
            $this->set_dbhost($dbhost);
        }

    } #  end function
*# **
     * Performs an SQL query.
     *
     * @param      String $sql
     * @return     int query identifier
     * @access     public
     * @scope      public
     */
    function query($sql)
    {
	    
        
        if (empty($this->dblink)) {
            #  check to see if there is an open connection. If not, create one.
            $this->connect();
        }

        $this->queryid = @mysql_query($sql, $this->dblink);

        if (!$this->queryid) {
            if ($this->begin_work) {
                $this->rollbackTransaction();
            }

            $this->return_error('No es posible efectuar el query <b>' . $sql . '</b>.');
        }

        $this->previd = 0;

        return $this->queryid;

    } #  end function


    /**
     * Connect to the database and change to the appropriate database.
     *
     * @param      none
     * @return     database link identifier
     * @access     public
     * @scope      public
     */
    
	function connect()
    {

	    
        $this->dblink = @mysql_connect($this->dbhost, $this->dblogin, $this->dbpass) or die ("Error: ".mysql_error());

        if (!$this->dblink) {
            $this->return_error('Noo es posible contectarse a la base de datos.');
        }

        $t = @mysql_select_db($this->dbname, $this->dblink);

        if (!$t) {
            $this->return_error('No es posible cambiar la base de datos.');
        }

        if ($this->serverHasTransaction()) {
            $this->transactions_capable = true;
        }

        return $this->dblink;
  }#  end function
   

#     } #  end function

    /**
     * Disconnect from the mySQL database.
     *
     * @param      none
     * @return     void
     * @access     public
     * @scope      public
     */
    function disconnect()
    {
        $test = @mysql_close($this->dblink);

        if (!$test) {
            $this->return_error('No es posible cerrar la conexion.');
        }

        unset($this->dblink);

    } #  end function

    /**
     * Stores error messages
     *
     * @param      String $message
     * @return     String
     * @access     private
     * @scope      public
     */
    function return_error($message)
    {
        return $this->error[] = $message.' '.mysql_error().'.';

    } #  end function

    /**
     * Show any errors that occurred.
     *
     * @param      none
     * @return     void
     * @access     public
     * @scope      public
     */
    function showErrors()
    {
        if ($this->hasErrors()) {
            reset($this->error);

            $errcount = count($this->error);    # count the number of error messages

            echo "<p>Error(es) encontrados: <b>'$errcount'</b></p>\n";

            #  print all the error messages.
            while (list($key, $val) = each($this->error)) {
                echo "+ $val<br>\n";
            }

            $this->resetErrors();
        }

    } #  end function

    /**
     * Checks to see if there are any error messages that have been reported.
     *
     * @param      none
     * @return     boolean
     * @access     private
     */
    function hasErrors()
    {
        if (count($this->error) > 0) {
            return true;
        } else {
            return false;
        }

    } #  end function

    /**
     * Clears all the error messages.
     *
     * @param      none
     * @return     void
     * @access     public
     */
    function resetErrors()
    {
        if ($this->hasErrors()) {
            unset($this->error);
            $this->error = array();
        }

    } #  end function

  
    /**
     * Grabs the records as a array.
     * [edited by MoMad to support movePrev()]
     *
     * @param      none
     * @return     array of db records
     * @access     public
     */
    function fetchRow()
    {
        if (isset($this->queryid)) {
            $this->previd++;
            return $this->record = @mysql_fetch_array($this->queryid);
        } else {
            $this->return_error('Query no especificado.');
        }

    } #  end function

    /**
     * Moves the record pointer to the first record
     * Contributed by MoMad
     *
     * @param      none
     * @return     array of db records
     * @access     public
     */
    function moveFirst()
    {
        if (isset($this->queryid)) {
            $t = @mysql_data_seek($this->queryid, 0);

            if ($t) {
                $this->previd = 0;
                return $this->fetchRow();
            } else {
                $this->return_error('No es posible moverse al primer registro.');
            }
        } else {
            $this->return_error('Query no especificado.');
        }

    } #  end function

    /**
     * Moves the record pointer to the last record
     * Contributed by MoMad
     *
     * @param      none
     * @return     array of db records
     * @access     public
     */
    function moveLast()
    {
        if (isset($this->queryid)) {
            $this->previd = $this->resultCount()-1;

            $t = @mysql_data_seek($this->queryid, $this->previd);

            if ($t) {
                return $this->fetchRow();
            } else {
                $this->return_error('No es posible moverse al ultimo registro.');
            }
        } else {
            $this->return_error('Query no especificado.');
        }

    } #  end function

    /**
     * Moves to the next record (internally, it just calls fetchRow() function)
     * Contributed by MoMad
     *
     * @param      none
     * @return     array of db records
     * @access     public
     */
    function moveNext()
    {
        return $this->fetchRow();

    } #  end function

    /**
     * Moves to the previous record
     * Contributed by MoMad
     *
     * @param      none
     * @return     array of db records
     * @access     public
     */
    function movePrev()
    {
        if (isset($this->queryid)) {
            if ($this->previd > 1) {
                $this->previd--;

                $t = @mysql_data_seek($this->queryid, --$this->previd);

                if ($t) {
                    return $this->fetchRow();
                } else {
                    $this->return_error('No es posible moverse al registro siguiente.');
                }
            } else {
                $this->return_error('BOF: EL primer registro ha sido alcanzado.');
            }
        } else {
            $this->return_error('Query no especificado.');
        }

    } #  end function


    /**
     * If the last query performed was an 'INSERT' statement, this method will
     * return the last inserted primary key number. This is specific to the
     * MySQL database server.
     *
     * @param        none
     * @return        int
     * @access        public
     * @scope        public
     * @since        version 1.0.1
     */
    function fetchLastInsertId()
    {
        $this->last_insert_id = @mysql_insert_id($this->dblink);

        if (!$this->last_insert_id) {
            $this->return_error('No es posible obtener el insert_id de MySQL.');
        }

        return $this->last_insert_id;

    } #  end function

    /**
     * Counts the number of rows returned from a SELECT statement.
     *
     * @param      none
     * @return     Int
     * @access     public
     */
    function resultCount()
    {
		
        $this->totalrecords = @mysql_num_rows($this->queryid);

        if (!$this->totalrecords) {
            $this->return_error('No es posible contabilizar el numero de filas retonrnadas');
        }

        return $this->totalrecords;

    } #  end function

    /**
     * Checks to see if there are any records that were returned from a
     * SELECT statement. If so, returns true, otherwise false.
     *
     * @param      none
     * @return     boolean
     * @access     public
     */
    function resultExist()
    {
        if (isset($this->queryid) && ($this->resultCount() > 0)) {
            return true;
        }

        return false;

    } #  end function

    /**
     * Clears any records in memory associated with a result set.
     *
     * @param      Int $result
     * @return     void
     * @access     public
     */
    function clear($result = 0)
    {
        if ($result != 0) {
            $t = @mysql_free_result($result);

            if (!$t) {
                $this->return_error('No es posible liberar resultados de la memoria.');
            }
        } else {
            if (isset($this->queryid)) {
                $t = @mysql_free_result($this->queryid);

                if (!$t) {
                    $this->return_error('No es posible liberar resultados de la memoria (interno).');
                }
            } else {
                $this->return_error('No existe un SELECT query, nada que liberar.');
            }
        }

    } #  end function

    /**
     * Checks to see whether or not the MySQL server supports transactions.
     *
     * @param      none
     * @return     bool
     * @access     public
     */
    function serverHasTransaction()
    {

	    
        $this->query('SHOW VARIABLES');

        if ($this->resultExist()) {
            while ($this->fetchRow()) {
                if ($this->record['Variable_name'] == 'have_bdb' && $this->record['Value'] == 'YES') {
                    $this->transactions_capable = true;
                    return true;
                }

                if ($this->record['Variable_name'] == 'have_gemini' && $this->record['Value'] == 'YES') {
                    $this->transactions_capable = true;
                    return true;
                }

                if ($this->record['Variable_name'] == 'have_innodb' && $this->record['Value'] == 'YES') {
                    $this->transactions_capable = true;
                    return true;
                }
            }
        }

        return false;

    } #  end function

    /**
     * Start a transaction.
     *
     * @param   none
     * @return  void
     * @access  public
     */
    function beginTransaction()
    {
        if ($this->transactions_capable) {
            $this->query('BEGIN');
            $this->begin_work = true;
        }

    } #  end function

    /**
     * Perform a commit to record the changes.
     *
     * @param   none
     * @return  void
     * @access  public
     */
    function commitTransaction()
    {
        if ($this->transactions_capable) {
            if ($this->begin_work) {
                $this->query('COMMIT');
                $this->begin_work = false;
            }
        }
    }

    /**
     * Perform a rollback if the query fails.
     *
     * @param   none
     * @return  void
     * @access  public
     */
    function rollbackTransaction()
    {
        if ($this->transactions_capable) {
            if ($this->begin_work) {
                $this->query('ROLLBACK');
                $this->begin_work = false;
            }
        }

    } #  end function
	
	function fetchObj()
    {
        if (isset($this->queryid)) {
            $this->previd++;
            return $this->record = @mysql_fetch_object($this->queryid);
        } else {
            $this->return_error('Query no especificado.');
        }

    } #  end function
	
	
} #  end class

?>
