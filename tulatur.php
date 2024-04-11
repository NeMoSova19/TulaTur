<?php
    class TulaTur{
        private static $connection;
        public static $_login;
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
        public static function Disconnect() {
            return mysqli_close(TulaTur::$connection);
        }

        public static function TryRegisterNewUser($user, $password){
            if(TulaTur::IsNameTaken($user)) {
                return "User already exists";
            }

            if(!TulaTur::TestPassword($password)){
                return "Invalid password";
            }

            TulaTur::RegisterNewUser($user, $password);
            return "OK";
        }

        public static function VerifyUser($user, $password){
            $result = TulaTur::GetUserRow($user);
            if($result === false) return "User not found";

            if(password_verify($password, $result["Password_hash"])){
                return "OK";
            }

            return "Password incorrect";
        }
        
        public static function GetAllPlaces(){
            return TulaTur::Request("SELECT * FROM Places")->fetch_all(MYSQLI_ASSOC);
        }

        public static function GetPlace($id){
            $data = TulaTur::Request("SELECT * FROM Places WHERE ID = $id");
            if($data->num_rows !== 1){
                return false;
            }
            return $data->fetch_assoc();
        }

        public static function GetUser($login){
            return TulaTur::GetUserRow($login);
        }

        public static function UserUnvisitPlace($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonVisited = json_decode($result["Visited"], false);
            if(in_array($id, $jsonVisited)){
                array_splice($jsonVisited, array_search($id, $jsonVisited), 1);
                $json = json_encode($jsonVisited);
                
                TulaTur::Request("UPDATE Users SET Visited='$json' WHERE Login = '$user'");
            }

            return true;
        }

        public static function UserVisitPlace($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonVisited = json_decode($result["Visited"], false);
            
            if(in_array($id, $jsonVisited)){
                return false;
            }

            array_push($jsonVisited, $id);
            $json = json_encode($jsonVisited);
            TulaTur::Request("UPDATE Users SET Visited='$json' WHERE Login = '$user'");

            return true;
        }

        public static function UserLikePlace($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonLike = json_decode($result["Ulike"], false);
            $jsonDislike = json_decode($result["Udislike"], false);
            if(in_array($id, $jsonLike)){
                return false;
            }
            if(in_array($id, $jsonDislike)){
                unset($jsonDislike[array_search($id, $jsonDislike)]);
                $json = json_encode($jsonDislike);

                TulaTur::Request("UPDATE Users SET Udislike='$json' WHERE Login = '$user'");
                TulaTur::Request("UPDATE Places SET Udislike=Udislike-1 WHERE Id = $id");
            }
            
            array_push($jsonLike, $id);
            $json = json_encode($jsonLike);
            TulaTur::Request("UPDATE Users SET Ulike='$json' WHERE Login = '$user'");
            TulaTur::Request("UPDATE Places SET Ulike=Ulike+1 WHERE Id = $id");

            return true;
        }

        public static function UserDislikePlace($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonLike = json_decode($result["Ulike"], false);
            $jsonDislike = json_decode($result["Udislike"], false);
            if(in_array($id, $jsonDislike)){
                return false;
            }
            if(in_array($id, $jsonLike)){
                unset($jsonLike[array_search($id, $jsonLike)]);
                $json = json_encode($jsonLike);

                TulaTur::Request("UPDATE Users SET Ulike='$json' WHERE Login = '$user'");
                TulaTur::Request("UPDATE Places SET Ulike=Ulike-1 WHERE Id = $id");
            }
            
            array_push($jsonDislike, $id);
            $json = json_encode($jsonDislike);
            TulaTur::Request("UPDATE Users SET Udislike='$json' WHERE Login = '$user'");
            TulaTur::Request("UPDATE Places SET Udislike=Udislike+1 WHERE Id = $id");

            return true;
        }

        public static function UserClearPlaceRating($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonLike = json_decode($result["Ulike"], false);
            $jsonDislike = json_decode($result["Udislike"], false);
            if(in_array($id, $jsonDislike)){
                unset($jsonDislike[array_search($id, $jsonDislike)]);
                $json = json_encode($jsonDislike);
                
                TulaTur::Request("UPDATE Users SET Udislike='$json' WHERE Login = '$user'");
                TulaTur::Request("UPDATE Places SET Udislike=Udislike-1 WHERE Id = $id");
                return;
            }
            if(in_array($id, $jsonLike)){
                unset($jsonDislike[array_search($id, $jsonDislike)]);
                $json = json_encode($jsonDislike, JSON_OBJECT_AS_ARRAY);
                
                TulaTur::Request("UPDATE Users SET Ulike='$json' WHERE Login = '$user'");
                TulaTur::Request("UPDATE Places SET Ulike=Ulike-1 WHERE Id = $id");
                return;
            }
            return;
        }
        
        public static function UserWriteComment($user, $id, $comment){
            $result = TulaTur::GetPlace($id);
            $json = json_decode($result["Comments"], true);
            $json[$user] = $comment;
            $json_str = json_encode($json,JSON_UNESCAPED_UNICODE);
            
            TulaTur::Request("UPDATE Places SET Comments='$json_str' WHERE Id = $id");
        }

        public static function GetAllTags(){
            return TulaTur::Request("SELECT * FROM Tags")->fetch_all(MYSQLI_ASSOC);
        }

        public static function IsUserLikePlace($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonLike = json_decode($result["Ulike"], false);
            if(in_array($id, $jsonLike)){
                return true;
            }
            return false;
        }

        public static function IsUserDislikePlace($user, $id){
            $result = TulaTur::GetUserRow($user);
            $jsonDislike = json_decode($result["Udislike"], false);
            if(in_array($id, $jsonDislike)){
                return true;
            }
            return false;
        }

        //////////////////////////////////////////////////////////////////

        private static function Request($request_string){
            return mysqli_query(TulaTur::$connection, $request_string);
        }

        private static function GetUserRow($user){
            $data = TulaTur::Request(sprintf("SELECT * FROM Users WHERE Login = '%s'", $user));
            if($data->num_rows !== 1){
                return false;
            }
            return $data->fetch_assoc();
        }

        private static function RegisterNewUser($user, $password){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            TulaTur::Request(sprintf("INSERT INTO Users VALUES ('%s', '%s', '[]', '[]', '[]')", $user, $hash));
        }

        private static function IsNameTaken($name) {
            return (bool)TulaTur::Request(sprintf("SELECT EXISTS(SELECT 1 FROM Users WHERE Login = '%s' LIMIT 1)", $name))->fetch_array()[0];
        }

        private static function TestPassword($password){
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
            return (bool)preg_match($pattern, $password);
        }
    }


    function getIntersect($arr1_json, $arr2)
{
    $arr1 = json_decode($arr1_json);
    foreach($arr1 as $val1)
    {
        foreach($arr2 as $val2)
        {
            if($val1 == $val2)
            { return true; }
        }
    }
    return false;
}

    function TwoStrings($what_find, $where_find){
        $what_find = mb_strtolower($what_find);
        $where_find = mb_strtolower($where_find);

        $arr_what = mb_split(' ', $what_find);
        $arr_where = mb_split(' ', $where_find);

        foreach($arr_what as $what){
            $max_percent = 0;
            foreach($arr_where as $where){
                $local_percent = 0;
                similar_text($what, $where, $local_percent);
                $max_percent = max($max_percent, $local_percent);
            }
            if($max_percent < 80) return false;
        }
        return true;
    }


    function Int2Week($i){
        switch ($i) {
            case 1:
                return "ПН";
            case 2:
                return "ВТ";
            case 3:
                return "СР";
            case 4:
                return "ЧТ";
            case 5:
                return "ПТ";
            case 6:
                return "СБ";
            case 7:
                return "ВС";
        }
        return "Это не день недели";
    }

    function GetTime($i){
        $h = $i/10000;
        $h_s = $h>=10?$h:'0'.$h;
        $m = $i/100%100;
        $m_s = $m>=10?$m:'0'.$m;
        return $h_s.":".$m_s;
    }

    function GetPrevPageOr($pageor){
        if(isset($_SESSION['prev_page'])){
            return $_SESSION['prev_page'];
        }
        return $pageor;
    }
?>