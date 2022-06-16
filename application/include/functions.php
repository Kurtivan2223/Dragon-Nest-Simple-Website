<?php
    $error_msg = "";
    $success_msg = "";

    function get_ip()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } 
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } 
        else 
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    function get_config($name)
    {
        global $config;
        if(!empty($name))
        {
            if(isset($config[$name]))
            {
                return $config[$name];
            }
        }

        return false;
    }

    //handlers
    function error_msg($input = false)
    {
        global $error_error;
        if(!empty($error_error))
        {
            echo "<p class=\"alert alert-danger\">$error_error</p>";
        }
        else if(!empty($input))
        {
            $error_error = $input;
        }
    }

    function success_msg($input = false)
    {
        global $success_msg;
        if(!empty($success_msg))
        {
            echo "<p class=\"alert alert-success\">$success_msg</p>";
        }
        else if(!empty($input))
        {
            $success_msg = $input;
        }
    }

    //other stuff
    function getAccountLevel($level)
    {
        switch($level)
        {
            case 0:
                return "Player";
            case 30:
                return "Game Master";
            case 99:
                return "Developer";
            default:
                exit("Error");
        }
    }

    function getClassName($cid)
    {
        switch($cid)
        {
            case 1:
                return  "WARRIOR";
            case 2:
                return  "ARCHER";
            case 3:
                return  "SOCERESS";
            case 4:
                return  "CLERIC";
            case 5:
                return  "ACADEMIC";
            case 6:
                return  "KALI";
            case 7:
                return  "ASSASSIN";
            case 8:
                return  "LENCEA";
            case 9:
                return  "MACHINA";
            case 10:
                return  "VANDAR";
            case 11:
                return  "SWORDMASTER";
            case 12:
                return  "MERCENARY";
            case 14:
                return  "BOWMASTER";
            case 15:
                return  "ACROBAT";
            case 17:
                return  "ELEMENTALLORD";
            case 18:
                return  "FORCEUSER";
            case 19:
                return  "WARLOCK";
            case 20:
                return  "PALADIN";
            case 21:
                return  "MONK";
            case 22:
                return  "PRIEST";
            case 23:
                return  "GLADIATOR";
            case 24:
                return  "MOONLORD";
            case 25:
                return  "BARBARIAN";
            case 26:
                return  "DESTROYER";
            case 29:
                return  "SNIPER";
            case 30:
                return  "ARTILLERY";
            case 31:
                return  "TEMPEST";
            case 32:
                return  "WINDWALKER";
            case 35:
                return  "SALEANA";
            case 36:
                return  "ELESTRA";
            case 37:
                return  "SMASHER";
            case 38:
                return  "MAJESTY";
            case 41:
                return  "GUARDIAN";
            case 42:
                return  "CRUSADES";
            case 43:
                return  "SAINT";
            case 44:
                return  "INQUISITOR";
            case 45:
                return  "EXORCIST";
            case 46:
                return  "ENGINEER";
            case 47:
                return  "SHOOTINGSTAR";
            case 48:
                return  "GEARMASTER";
            case 49:
                return  "ALCHEMIST";
            case 50:
                return  "ADEPT";
            case 51:
                return  "PHYSICIAN";
            case 54:
                return  "SCREAMER";
            case 55:
                return  "DARKSUMMONER";
            case 56:
                return  "SOULEATER";
            case 57:
                return  "DANCER";
            case 58:
                return  "BLADEDANCER";
            case 59:
                return  "SPIRITDANCER";
            case 62:
                return  "CHASER";
            case 63:
                return  "RIPPER";
            case 64:
                return  "RAVEN";
            case 67:
                return  "BRINGER";
            case 68:
                return  "LIGHTFURY";
            case 69:
                return  "ABYSSWALKER";
            case 72:
                return  "PIERCER";
            case 73:
                return  "FLURRY";
            case 74:
                return  "STINGBREEZER";
            case 75:
                return  "AVENGER";
            case 76:
                return  "DARKAVENGER";
            case 77:
                return  "PATRONA";
            case 78:
                return  "DEFENSIO";
            case 79:
                return  "RUINA";
            case 80:
                return  "HUNTER";
            case 81:
                return  "SILVERHUNTER";
            case 82:
                return  "HERETIC";
            case 83:
                return  "ARCHHERETIC";
            case 84:
                return  "MARA";
            case 85:
                return  "BLACKMARA";
            case 86:
                return  "MECHANIC";
            case 87:
                return  "RAYMECHANIC";
            case 88:
                return  "ORACLE";
            case 89:
                return  "ORACLEELDER";
            case 90:
                return  "PHANTOM";
            case 91:
                return  "BLEEDPHANTOM";
            case 92:
                return  "KNIGHTESS";
            case 93:
                return  "AVALANCHE";
            case 94:
                return  "RANDGRID";
            case 95:
                return  "LAUNCHER";
            case 96:
                return  "IMPACTOR";
            case 97:
                return  "LUSTRE";
            case 98:
                return  "PLAGA";
            case 99:
                return  "VENAPLAGA";
            case 100:
                return  "TREASUREHUNTER";
            case 102:
                return  "DUELIST";
            case 103:
                return  "TRICKSTER";
            case 106:
                return  "KNIGHT";
            case 107:
                return  "MYSTICKNIGHT";
            case 108:
                return  "GRANDMASTER";
            case 114:
                return  "ANCESTOR";
            default:
                exit("Error");
        }
    }