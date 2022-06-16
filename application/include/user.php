<?php
    class user
    {
        public static function post_handler()
        {
            if(isset($_POST['register']))
            {
                self::register();
            }
            else if(isset($_POST['login']))
            {
                self::login();
            }
        }

        public static function get_intIp()
        {
            $ip = get_ip();

            $request = database::$connection->query("
            DECLARE @vchLoginIP varchar(15) = '$ip'
            DECLARE @secret int = dbo.FN_IP2IPNumber(@vchLoginIP)

            SELECT @secret AS IP");

            $result = $request->fetchall();

            foreach ($request as $get)
            {
                $get[0];
            }

            return $get[0];
        }

        public static function getLoginData($username, $password)
        {
            $md5 = md5($password);
            $request = database::$connection->prepare("
            SELECT
                AccountName
                RLKTPassword
            FROM
                DNMembership.dbo.Accounts
            WHERE
                AccountName = :user
            AND
            RLKTPassword = :pass");
            $request->bindParam(':user', $username, PDO::PARAM_STR);
            $request->bindParam(':pass', $md5, PDO::PARAM_STR);
            $request->execute();

            foreach($request as $get)
            {
                $get[0];
            }

            if(!empty($get[0]))
            {
                return 1;
            }
            else
            {
                return 0;
                unset($_POST);
                $_POST = array();
            }
        }

        public static function getRegistrationData($username, $email)
        {
            $request = database::$connection->prepare("
            SELECT
                AccountID,
                AccountName
            FROM
                DNMembership.dbo.Accounts
            WHERE
                AccountName = :user
            AND
                Email = :mail");

            $request->bindParam(':user', $username, PDO::PARAM_STR);
            $request->bindParam(':mail', $email, PDO::PARAM_STR);
            $request->execute();
            
            $result = $request->fetchall();

            foreach($result as $get)
            {
                $get[0];
            }

            if($get[0])
            {
                return 1;
                unset($_POST);
                $_POST = array();
            }
            else
            {
                return 0;
            }
        }

        public static function register()
        {
            if(empty($username) || empty($password) || empty($repassword) || empty($email))
            {
                error_msg("Username/Password/Repassword/Email Field is empty!");
            }
            else if(strlen($password) <= 6)
            {
                error_msg("Password must be longer than 6 Characters long!");
            }
            else if($password != $repassword)
            {
                error_msg("Password didn't Matched!");
            }
            else
            {
                $checkExists = self::getRegistrationData();

                if($checkExists == 1)
                {
                    error_msg("Username or Email Already Exists!");
                }
                else
                {
                    try
                    {
                        $ip = get_intIp();
                        $request = database::$connection->prepare("
                        EXEC
                            DNMembership.dbo.__CreateAccount
                            @AccountName :user,
                            @Password :pass,
                            @IPAddress :ip,
                            @Email :mail,
                            @Birth :birth
                        ");
                        $request->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
                        $request->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
                        $request->bindParam(':ip', $ip, PDO::PARAM_INT);
                        $request->bindParam(':mail', $email, PDO::PARAM_STR);
                        $request->bindParam(':birth', $_POST['Year'].$_POST['Month'].$_POST['Day'], PDO::PARAM_STR);
                        $request->execute();

                        success_msg("Successfully Registered! You can now Login and Play the Game.");
                    }
                    catch(Exception $e)
                    {
                        die("Exception Occured! Error: " . $e->getMessage());
                    }
                }
            }
        }

        public static function login()
        {
            if(empty($_POST['username']) || empty($_POST['password']))
            {
                error_msg("Username/Password Field is empty!");
            }
            else
            {
                $check = self::getLoginData($_POST['username'], $_POST['password']);

                if($check == 0)
                {
                    error_msg("User doesn't exists!");
                }
                else
                {
                    try
                    {
                        $md5 = md5($_POST['password']);
                        $request = database::$connection->prepare("
                        SELECT
                            AccountID,
                            AccountName
                        FROM
                            DNMembership.dbo.Accounts
                        WHERE
                            AccountName = :user
                        AND
                            RLKTPassword = :pass");

                        $request->bindParam(':user', $username, PDO::PARAM_STR);
                        $request->bindParam(':pass', $md5, PDO::PARAM_STR);
                        $request->execute();
                    }
                    catch(Exception $e)
                    {
                        die("Exception Occured! Error: " . $e->getMessage());
                    }
                }
            }
        }

        public static function get_user_info()
        {
            $request = database::$connection->query("
            SELECT 
                AccountID,
                AccountName,
                AccountLevelCode,
                JoinIP,
                RegisterDate,
                BirthDate,
                cash,
                Email
            FROM
                DNMembership.dbo.Accounts
            WHERE
                AccountName = '$user' AND RlktPassword = '$pass'
            FOR
                JSON PATH");

            $result = $request->fetchall();

            foreach($result as $get)
            {
                $get[0];
            }

            return $get[0];
        }
    }