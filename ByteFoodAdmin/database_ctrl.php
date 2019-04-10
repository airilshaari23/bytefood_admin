<?php
	class Member {
		var $id;
		var $type;
    	var $username;
    	var $name;
    	var $age;
    	var $email;
    	var $address; 
    	var $dob; 
    	var $photo; 
    	var $status; 
    	var $addeddate;
   	}

   	class Menu {
   		var $id;
   		var $menu_name;
    	var $menu_type;
    	var $menu_category;
    	var $menu_price;
    	var $menu_status; 
    	var $addeddate; 
   	}

   	class OrderHis {
   		var $order_no;
    	var $order_status;
    	var $order_date;
    	var $foodprice;
    	var $user_id;
    	var $membership_id;
   	}

   	class Order {
   		var $id;
   		var $order_no;
    	var $menu_name;
    	var $order_quantity;
    	var $order_date;
    	var $user_id; 
   	}

   	class DeleteResult {
	    var $status;
	    var $error;
   	}

   	class InsertResult {
      var $status;
      var $error;
   	}

   	class UpdateResult {
      var $status;
      var $error;
   	}

   	function time_elapsed_string($datetime, $full = false) {
      	if ($datetime == '0000-00-00 00:00:00')
         	return "none";

      	$now = new DateTime;
      	$ago = new DateTime($datetime);
      	$diff = $now->diff($ago);

      	$diff->w = floor($diff->d / 7);
      	$diff->d -= $diff->w * 7;

      	$string = array(
         	'y' => 'year',
         	'm' => 'month',
         	'w' => 'week',
         	'd' => 'day',
         	'h' => 'hour',
         	'i' => 'minute',
         	's' => 'second',
      	);
      
      	foreach ($string as $k => &$v) {
         	if ($diff->$k) {
            	$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
         	} else {
            	unset($string[$k]);
         	}
      	}

      	if (!$full) $string = array_slice($string, 0, 1);
         	return $string ? implode(', ', $string) . ' ago' : 'just now';
   	}

	class Database {
 		protected $dbhost;
    	protected $dbuser;
    	protected $dbpass;
    	protected $dbname;
    	protected $db;

	 	function __construct( $dbhost, $dbuser, $dbpass, $dbname) {
	   		$this->dbhost = $dbhost;
	   		$this->dbuser = $dbuser;
	   		$this->dbpass = $dbpass;
	   		$this->dbname = $dbname;

	   		$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	        $db->setAttribute(PDO::MYSQL_ATTR_FOUND_ROWS, true);
	    	$this->db = $db;
	   	}
	   	function beginTransaction() {
	        try {
	           $this->db->beginTransaction(); 
	        }
	        catch(PDOException $e) {
	           $errorMessage = $e->getMessage();
	           return 0;
	        } 
	    }

      	function commit() {
         	try {
            	$this->db->commit();
         	}
         	catch(PDOException $e) {
            	$errorMessage = $e->getMessage();
            	return 0;
         	} 
      	}

      	function rollback() {
         	try {
            	$this->db->rollback();
         	}
         	catch(PDOException $e) {
            	$errorMessage = $e->getMessage();
            	return 0;
         	} 
      	}

      	function close() {
         	try {
            	$this->db = null;   
         	}
         	catch(PDOException $e) {
            	$errorMessage = $e->getMessage();
            	return 0;
         	} 
      	}
		function loginvalidation($username, $password) {
	        $sql = "SELECT *
	                FROM membership
	                WHERE username = :username
	                AND password = :password
	                AND type = 1";

	        $stmt = $this->db->prepare($sql);
	        $stmt->bindParam("username", $username);
	        $stmt->bindParam("password", $password);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        $member = new Member();

	        if ($row_count)
	        {
	        	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	        	{
	        		$member->username = $row['username'];
	        		$member->name = $row['name'];
	        		$member->age = $row['age'];
	        		$member->email = $row['email'];
	        		$member->address = $row['address'];
	        		if ($row['dob'] != NULL){
	        		 $member->dob = $row['dob'];
	        		}
	        		else{
	        		 $member->dob = NULL;
	        		}
	        		$member->photo = $row['photo'];
	        		$member->status = $row['status']; 
	        		$member->addeddate = $row['addeddate'];
	        	}
	        }

	        return $member;
		}
		function menufood_listing(){
			$sql = "SELECT *
	                FROM menu_listing
	                WHERE menu_type = 'food'
	                ORDER BY menu_category, menu_name";

	        $stmt = $this->db->prepare($sql);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        

	        if ( count($row_count) )
	        {
	            $data_menu = array();

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $menu = new Menu();
	               $menu->id = $row['id'];
	               $menu->menu_name = $row['menu_name'];
	               $menu->menu_type = $row['menu_type'];
	               $menu->menu_category = $row['menu_category'];
	               $menu->menu_price = number_format($row['menu_price'],2);
	               $menu->menu_status = $row['menu_status'];
	               $addeddate = $row['addeddate'];
               	   $menu->addeddate = time_elapsed_string($addeddate);
	               array_push($data_menu, $menu);
	            }
	        }
	        //print_r($data_menu);
	        //exit();
	        return $data_menu;	
		}
		function menudrink_listing(){
			$sql = "SELECT *
	                FROM menu_listing
	                WHERE menu_type = 'drink'
	                 ORDER BY menu_category, menu_name";

	        $stmt = $this->db->prepare($sql);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        

	        if ( count($row_count) )
	        {
	            $data_menu = array();

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $menu = new Menu();
	               $menu->id = $row['id'];
	               $menu->menu_name = $row['menu_name'];
	               $menu->menu_type = $row['menu_type'];
	               $menu->menu_category = $row['menu_category'];
	               $menu->menu_price = number_format($row['menu_price'],2);
	               $menu->menu_status = $row['menu_status'];
	               $addeddate = $row['addeddate'];
               	   $menu->addeddate = time_elapsed_string($addeddate);
	               array_push($data_menu, $menu);
	            }
	        }
	        //print_r($data_menu);
	        //exit();
	        return $data_menu;	
		}
		function deleteMenuViaId($id) {
	     	$sql = "DELETE 
	                FROM menu_listing 
	                WHERE id = :id";

	     	try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->execute();

	            $deleteResult = new DeleteResult();
	            $deleteResult->status = true;
	            return $deleteResult;            
	 		}
	     	catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $deleteResult = new DeleteResult();
	            $deleteResult->status = false;
	            $deleteResult->error = $errorMessage;
	            return $deleteResult;
	     	}           
      	}
      	function insertMenu($menu_name, $menu_type, $menu_price, $menu_category) {
	        $sql = "INSERT INTO menu_listing(menu_name, menu_type, menu_price, menu_category, addeddate)
	                VALUES (:menu_name, :menu_type, :menu_price, :menu_category, NOW())";

	        try {
	            $stmt = $this->db->prepare($sql);  
	            $stmt->bindParam("menu_name", $menu_name);
	            $stmt->bindParam("menu_type", $menu_type);
	            $stmt->bindParam("menu_category", $menu_category);
	            $stmt->bindParam("menu_price", $menu_price);
	            $stmt->execute();

	            $insertResult = new InsertResult();
	            $insertResult->status = true;
	            return $insertResult;
	            
	            //return $this->db->lastInsertId();
	         }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $insertResult = new InsertResult();
	            $insertResult->status = false;
	            $insertResult->error = $errorMessage;
	            return $insertResult;
         	}                      
      	}
      	function statusMenuViaId($id, $menu_status){
      		if ($menu_status == 'A')
      			$menu_status = 'S';
      		else
      			$menu_status = 'A';
      		$sql = "UPDATE menu_listing 
      				SET menu_status = :menu_status
      				WHERE id = :id";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->bindParam("menu_status", $menu_status);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function getMenuViaId($id){
      		$sql = "SELECT *
      				FROm menu_listing
      				WHERE id = :id";

      		$stmt = $this->db->prepare($sql);
	        $stmt->bindParam("id", $id);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        $menu = new Menu();

	        if ($row_count)
	        {
	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $menu->menu_name = $row['menu_name'];
	               $menu->menu_type = $row['menu_type'];
	               $menu->menu_price = $row['menu_price'];
	               $menu->menu_category = $row['menu_category'];
	               $menu->menu_status = $row['menu_status'];
	            }
	        }

	        return $menu;
      	}
      	function updateMenuViaId($id, $menu_name, $menu_type, $menu_price, $menu_status, $menu_category){
      		$sql = "UPDATE menu_listing
      				SET menu_name = :menu_name,
      				menu_type = :menu_type,
      				menu_price = :menu_price,
      				menu_status = :menu_status,
      				menu_category = :menu_category
      				WHERE id = :id";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->bindParam("menu_name", $menu_name);
	            $stmt->bindParam("menu_type", $menu_type);
	            $stmt->bindParam("menu_price", $menu_price);
	            $stmt->bindParam("menu_status", $menu_status);
	            $stmt->bindParam("menu_category", $menu_category);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function admin_listing(){
			$sql = "SELECT *
	                FROM membership
	                WHERE type = 1";

	        $stmt = $this->db->prepare($sql);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        

	        if ( count($row_count) )
	        {
	            $data_admin = array();

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $admin = new Member();
	               $admin->id = $row['id'];
	               $admin->type = $row['type'];
	               $admin->username = $row['username'];
	               $admin->name = $row['name'];
	               $admin->age = $row['age'];
	               $admin->email = $row['email'];
	               $admin->address = $row['address'];
	               if ($row['dob'] != NULL){
	               	$admin->dob = date("d-m-Y",strtotime($row['dob']));
	           	   }
	           	   else{
	           	   	$admin->dob = NULL;
	           	   }
	               $admin->photo = $row['photo'];
	               $admin->status = $row['status'];
	               $addeddate = $row['addeddate'];
               	   $admin->addeddate = time_elapsed_string($addeddate);
	               array_push($data_admin, $admin);
	            }
	        }
	        //print_r($data_admin);
	        //exit();
	        return $data_admin;	
		}
		function statusAdminViaId($id, $status){
      		if ($status == 0)
      			$status = 2;
      		else if ($status == 1)
      			$status = 0;
      		else if ($status == 2)
      			$status = 1;
      		$sql = "UPDATE membership 
      				SET status = :status
      				WHERE id = :id
      				AND type = 1";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->bindParam("status", $status);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function deleteAdminViaId($id) {
	     	$sql = "DELETE 
	                FROM membership 
	                WHERE id = :id
	                AND type = 1";

	     	try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->execute();

	            $deleteResult = new DeleteResult();
	            $deleteResult->status = true;
	            return $deleteResult;            
	 		}
	     	catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $deleteResult = new DeleteResult();
	            $deleteResult->status = false;
	            $deleteResult->error = $errorMessage;
	            return $deleteResult;
	     	}           
      	}
      	function insertAdmin($name, $username, $password) {
         	$sql = "INSERT INTO membership(type, name, username, password, addeddate)
                 	VALUES (1, :name, :username, :password, NOW())";

         	try {
            	$stmt = $this->db->prepare($sql);  
            	$stmt->bindParam("name", $name);
            	$stmt->bindParam("username", $username);
            	$stmt->bindParam("password", $password);
            	$stmt->execute();

            	$insertResult = new InsertResult();
            	$insertResult->status = true;
            	return $insertResult;
            
            	//return $this->db->lastInsertId();
         	}
         	catch(PDOException $e) {
            	$errorMessage = $e->getMessage();

            	$insertResult = new InsertResult();
            	$insertResult->status = false;
            	$insertResult->error = $errorMessage;
            	return $insertResult;
         	}                      
      	}
      	function getAdminViaId($id){
      		$sql = "SELECT *
      				FROm membership
      				WHERE id = :id
      				AND type = 1";

      		$stmt = $this->db->prepare($sql);
	        $stmt->bindParam("id", $id);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        $admin = new Member();

	        if ($row_count)
	        {
	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $admin->id = $row['id'];
	               $admin->type = $row['type'];
	               $admin->username = $row['username'];
	               $admin->name = $row['name'];
	               $admin->age = $row['age'];
	               $admin->email = $row['email'];
	               $admin->address = $row['address'];
	               if ($row['dob'] != NULL){
	               	$admin->dob = date("d-m-Y",strtotime($row['dob']));
	               }
	               else{
	               	$admin->dob = NULL;
	               }

	               $admin->photo = $row['photo'];
	               $admin->status = $row['status'];
	               $admin->addeddate = $row['addeddate'];
	            }
	        }

	        return $admin;
      	}
      	function updateAdminViaId($id, $status, $type){
      		$sql = "UPDATE membership
      				SET status = :status,
      				type = :type
      				WHERE id = :id";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->bindParam("status", $status);
	            $stmt->bindParam("type", $type);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function getProfileInfo($username){
      		$sql = "SELECT *
      				FROM membership
      				WHERE username = :username";

      		$stmt = $this->db->prepare($sql);
	        $stmt->bindParam("username", $username);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        $profile = new Member();

	        if ($row_count)
	        {
	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $profile->id = $row['id'];
	               $profile->type = $row['type'];
	               $profile->username = $row['username'];
	               $profile->name = $row['name'];
	               $profile->age = $row['age'];
	               $profile->email = $row['email'];
	               $profile->address = $row['address'];
	               if ($row['dob']){
	               	$profile->dob = date("d-m-Y",strtotime($row['dob']));
	               }
	               else{
	               	$profile->dob = NULL;
	               }

	               $profile->photo = $row['photo'];
	               $profile->status = $row['status'];
	               $profile->addeddate = $row['addeddate'];
	            }
	        }

	        return $profile;
      	}
      	function editProfile($username, $name, $age, $email, $address, $dob){
      		$sql = "UPDATE membership
      				SET name = :name,
      				age = :age,
      				email = :email,
      				address = :address,
      				dob = :dob
      				WHERE username = :username";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("username", $username);
	            $stmt->bindParam("name", $name);
	            $stmt->bindParam("age", $age);
	            $stmt->bindParam("email", $email);
	            $stmt->bindParam("address", $address);
	            $stmt->bindParam("dob", $dob);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function updateProfilePhoto($username, $photo) {
	        $sql = "UPDATE membership
	                SET photo = :photo
	                WHERE username = :username";

	        try {
	           	$stmt = $this->db->prepare($sql); 
	           	$stmt->bindParam("username", $username);
	           	$stmt->bindParam("photo", $photo);
	           	$stmt->execute();

	           	$updateResult = new UpdateResult();
	           	$updateResult->status = true;
	           	return $updateResult;
	        }
	        catch(PDOException $e) {
	           	$errorMessage = $e->getMessage();

	           	$updateResult = new InsertResult();
	           	$updateResult->status = false;
	           	$updateResult->error = $errorMessage;
	           	return $updateResult; 
	        }       
	    }
	    function editPassword($username, $password){
      		$sql = "UPDATE membership
      				SET password = :password
      				WHERE username = :username";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("username", $username);
	            $stmt->bindParam("password", $password);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
	    function customer_listing(){
			$sql = "SELECT *
	                FROM membership
	                WHERE type != 1";

	        $stmt = $this->db->prepare($sql);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        

	        if ( count($row_count) )
	        {
	            $data_cust = array();

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $customer = new Member();
	               $customer->id = $row['id'];
	               $customer->type = $row['type'];
	               $customer->username = $row['username'];
	               $customer->name = $row['name'];
	               $customer->age = $row['age'];
	               $customer->email = $row['email'];
	               $customer->address = $row['address'];
	               if ($row['dob'] != NULL){
	               	$customer->dob = date("d-m-Y",strtotime($row['dob']));
	           	   }
	           	   else{
	           	   	$customer->dob = NULL;
	           	   }
	               $customer->photo = $row['photo'];
	               $customer->status = $row['status'];
	               $addeddate = $row['addeddate'];
               	   $customer->addeddate = time_elapsed_string($addeddate);
	               array_push($data_cust, $customer);
	            }
	        }
	        //print_r($data_admin);
	        //exit();
	        return $data_cust;	
		}
		function statusCustomerViaId($id, $status){
      		if ($status == 0)
      			$status = 2;
      		else if ($status == 1)
      			$status = 0;
      		else if ($status == 2)
      			$status = 1;
      		$sql = "UPDATE membership 
      				SET status = :status
      				WHERE id = :id
      				AND type != 1";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->bindParam("status", $status);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function deleteCustomerViaId($id) {
	     	$sql = "DELETE 
	                FROM membership 
	                WHERE id = :id
	                AND type != 1";

	     	try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->execute();

	            $deleteResult = new DeleteResult();
	            $deleteResult->status = true;
	            return $deleteResult;            
	 		}
	     	catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $deleteResult = new DeleteResult();
	            $deleteResult->status = false;
	            $deleteResult->error = $errorMessage;
	            return $deleteResult;
	     	}           
      	}
      	function getCustomerViaId($id){
      		$sql = "SELECT *
      				FROm membership
      				WHERE id = :id
      				AND type != 1";

      		$stmt = $this->db->prepare($sql);
	        $stmt->bindParam("id", $id);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        $customer = new Member();

	        if ($row_count)
	        {
	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $customer->id = $row['id'];
	               $customer->type = $row['type'];
	               $customer->username = $row['username'];
	               $customer->name = $row['name'];
	               $customer->age = $row['age'];
	               $customer->email = $row['email'];
	               $customer->address = $row['address'];
	               if ($row['dob'] != NULL){
	               	$customer->dob = date("d-m-Y",strtotime($row['dob']));
	               }
	               else{
	               	$customer->dob = NULL;
	               }

	               $customer->photo = $row['photo'];
	               $customer->status = $row['status'];
	               $customer->addeddate = $row['addeddate'];
	            }
	        }

	        return $customer;
      	}
      	function updateCustomerViaId($id, $status, $type){
      		$sql = "UPDATE membership
      				SET status = :status,
      				type = :type
      				WHERE id = :id";

      		try {
	            $stmt = $this->db->prepare($sql); 
	            $stmt->bindParam("id", $id);
	            $stmt->bindParam("status", $status);
	            $stmt->bindParam("type", $type);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function insertCustomer($name, $username, $password) {
         	$sql = "INSERT INTO membership(name, username, password, addeddate)
                 	VALUES (:name, :username, :password, NOW())";

         	try {
            	$stmt = $this->db->prepare($sql);  
            	$stmt->bindParam("name", $name);
            	$stmt->bindParam("username", $username);
            	$stmt->bindParam("password", $password);
            	$stmt->execute();

            	$insertResult = new InsertResult();
            	$insertResult->status = true;
            	return $insertResult;
            
            	//return $this->db->lastInsertId();
         	}
         	catch(PDOException $e) {
            	$errorMessage = $e->getMessage();

            	$insertResult = new InsertResult();
            	$insertResult->status = false;
            	$insertResult->error = $errorMessage;
            	return $insertResult;
         	}                      
      	}
      	function order_listing($order_date){
			$sql = "SELECT order_history.order_no, SUM(order_history.price_per_unit*order_history.order_quantity) AS foodprice, order_history.order_status, order_history.order_date, order_history.user_id, membership.id AS membership_id
	                FROM order_history
	                JOIN membership ON order_history.user_id = membership.username
	                WHERE DATE(order_date) = :order_date
	                GROUP BY order_no DESC";

	        $stmt = $this->db->prepare($sql);
	        $stmt->bindParam("order_date", $order_date);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        

	        if ( count($row_count) )
	        {
	            $data_order = array();

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $order = new OrderHis();
	               $order->order_no = $row['order_no'];
	               $order->order_status = $row['order_status'];
	               $order->foodprice = number_format($row['foodprice'],2);
	               $order_date = $row['order_date'];
               	   $order->order_date = time_elapsed_string($order_date);
	               $order->user_id = $row['user_id'];
	               $order->membership_id = $row['membership_id'];
	               array_push($data_order, $order);
	            }
	        }
	        //print_r($data_menu);
	        //exit();
	        return $data_order;	
		}
		function statusOrderViaOrderNo($order_no, $order_status){
      		if ($order_status == 0)
      			$order_status = 1;
      		else if ($order_status == 1)
      			$order_status = 2;
      		else if ($order_status == 2)
      			$order_status = 0;
      		$sql = "UPDATE order_history 
      				SET order_status = :order_status
      				WHERE order_no = :order_no";

      		try {
	            $stmt = $this->db->prepare($sql);
	            $stmt->bindParam("order_no", $order_no);
	            $stmt->bindParam("order_status", $order_status);
	            $stmt->execute();

	            $updateResult = new UpdateResult();
	            $updateResult->status = true;
	            return $updateResult;
	        }
	        catch(PDOException $e) {
	            $errorMessage = $e->getMessage();

	            $updateResult = new InsertResult();
	            $updateResult->status = false;
	            $updateResult->error = $errorMessage;
	            return $updateResult; 
	        }
      	}
      	function orderDetails($order_no){
			$sql = "SELECT *
	                FROM order_history
	                WHERE order_no = :order_no";

	        $stmt = $this->db->prepare($sql);
	        $stmt->bindParam("order_no", $order_no);
	        $stmt->execute(); 
	        $row_count = $stmt->rowCount();

	        

	        if ( count($row_count) )
	        {
	            $data_order = array();

	            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	            {
	               $order = new OrderHis();
	               $order->id = $row['id'];
	               $order->order_no = $row['order_no'];
	               $order->menu_name = $row['menu_name'];
	               $order->order_quantity = $row['order_quantity'];
	               $order->price_per_unit = number_format($row['price_per_unit'],2);
	               $order->order_status = $row['order_status'];
	               $order->user_id = $row['user_id'];
	               $order_date = $row['order_date'];
               	   $order->order_date = time_elapsed_string($order_date);
	               array_push($data_order, $order);
	            }
	        }
	        //print_r($data_menu);
	        //exit();
	        return $data_order;	
		}
	}
?>