<?php
    class TulaTur{
        private static $connection;
        public static $_login;
        public static function Connect() {
            $servername = "k90653re.beget.tech";
            $username = "k90653re_bd";
            $password = "Mysql123";
            $base = "k90653re_bd";  
            TulaTur::$connection = new mysqli($servername,$username,$password, $base);
            
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
?>