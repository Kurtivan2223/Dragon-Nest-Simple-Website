<?php
    function server_time()
    {
        return date('h:i A', time());
    }

    function OnlineCount()
    {
        $request = database::$connection->query("
        SELECT
            COUNT(AccountName)
        AS
            Online
        FROM
            DNMembership.dbo.DNAuth
        WHERE
            CertifyingStep = 2");

        $result = $request->fetchall();

        foreach($result as $get)
        {
            echo $get[0];
        }
    }

    function AccountCount()
    {
        $request = database::$connection->query("
        SELECT
            COUNT(*)
        FROM
            DNMembership.dbo.Accounts");

        $result = $request->fetchall();

        foreach($result as $get)
        {
            echo $get[0];
        }
    }

    function CharacterCount()
    {
        $request = database::$connection->query("
        SELECT
            COUNT(*)
        FROM
            DNWorld.dbo.Characters");

        $result = $request->fetchall();

        foreach($result as $get)
        {
            echo $get[0];
        }
    }

    function GuildCount()
    {
        $request = database::$connection->query("
        SELECT
            COUNT(*)
        FROM
            DNWorld.dbo.Guilds");

        $result = $request->fetchall();

        foreach($result as $get)
        {
            echo $get[0];
        }
    }