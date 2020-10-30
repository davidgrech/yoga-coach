<?php

    session_start();

    if(!isset($_SESSION['clientlogin'])){
        header('location:../login.php');
    }

?>

<!doctype html>
<html>
<head>
    <title>Rowan Cobelli</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler.js"></script>

    <script src=" https://cdn.dhtmlx.com/scheduler/edge/ext/dhtmlxscheduler_readonly.js?_ga=2.225356378.1984324305.1587819059-1045433494.1587819059"></script>
    
    <link href="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler_material.css" 
            rel="stylesheet" type="text/css" charset="utf-8">
    <style>
        html, body{
            margin:0px;
            padding:0px;
            height:100%;
            overflow:hidden;
        }

    </style> 

</head> 
<body> 

    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'> 
        <div class="dhx_cal_navline"> 
            <div class="dhx_cal_prev_button">&nbsp;</div> 
            <div class="dhx_cal_next_button">&nbsp;</div> 
            <div class="dhx_cal_today_button"></div> 
            <div class="dhx_cal_date"></div> 
            <div class='mt-3'>
                <div class="dhx_cal_tab" name="day_tab"></div> 
                <div class="dhx_cal_tab" name="week_tab"></div> 
                <div class="dhx_cal_tab" name="month_tab"></div> 
            </div>
    </div> 
    <div class="dhx_cal_header mt-4"></div> 
    <div class="dhx_cal_data mt-4"></div> 

    <script>
        //read only light box
        scheduler.config.readonly_form = true;

        scheduler.init('scheduler_here', new Date(2020,3,20), "month");
        scheduler.load("data/api.php");
        
        //block event resize and drag
        scheduler.attachEvent("onBeforeDrag",function(){return false;});

        //block selection menus
        scheduler.attachEvent("onClick",function(){return false;});
        
        //block event creation by doubleclick
        scheduler.config.dblclick_create = false;

        var dp = new dataProcessor("data/api.php");
        dp.init(scheduler);
        dp.setTransactionMode("JSON"); 

    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body> 
</html>