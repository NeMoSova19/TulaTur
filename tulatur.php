<?php
    class TulaTur{
        private static $connection;
        public static function Connect() {
            $servername = "k90653re.beget.tech";
            $username = "k90653re_bd";
            $password = "Mysql123";
            $base = "k90653re_bd";  
            TulaTur::$connection = mysqli_connect($servername,$username,$password, $base);
            if(TulaTur::$connection) {
                return true;
            }
            return false;
        } 

        public static function IsFreeName($name) {
            return !TulaTur::TableHasVarInColumn("Users", "login", $name);
        }

        public static function RegisterNewUser($user, $password){
            if(!TulaTur::IsFreeName($user)) {
                return false;
            }
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $request_string = sprintf("INSERT INTO Users VALUES ('%s', '%s', '{}')", $user, $hash);
            TulaTur::Request($request_string);
            return true;
        }

        public static function CheckPassword($user, $password){
            if(!TulaTur::IsFreeName($user)) {
                $data = TulaTur::Request(sprintf("SELECT * FROM Users WHERE login = '%s'", $user))->fetch_array();
                if(password_verify($password, $data[1])){
                    return true;
                }
            }
            return false;
        }
        
        private static function Request($request_string){
            return mysqli_query(TulaTur::$connection, $request_string);
        }

        private static function TableHasVarInColumn($table, $column, $value){
            return (bool)mysqli_query(TulaTur::$connection, sprintf("SELECT EXISTS(SELECT 1 FROM %s WHERE %s = '%s' LIMIT 1)", $table, $column, $value))->fetch_array()[0];
        }
    }
    
    if(!TulaTur::Connect()) die(404);

    if(TulaTur::CheckPassword("Sova4", "testpass")){
        echo "OK";
    }
    else{
        echo "NOK";
    }
    if(TulaTur::IsFreeName("Sova4")){
        TulaTur::RegisterNewUser("Sova4", "testpass");
        echo "User created successfully";
    }
    else{
        echo "NOK";
    }
    
    //print_r($result1);
    //$result2 = Request($connection, "INSERT INTO Users VALUES ('Sova1', 1234567890)");

    //foreach($result1 as $row){
    //    print_r($row["login"]);
    //    print_r('  |  ');
    //    print_r($row["password_hash"]);
    //    print_r('  ||  ');
    //}
?>