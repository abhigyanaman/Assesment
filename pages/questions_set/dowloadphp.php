<?php

// include autoloader
require_once 'dompdf/dompdf/autoload.inc.php';
require 'C:\xampp\htdocs\assessment\vendor\autoload.php';

    use Dompdf\Dompdf;

    $conn=mysqli_connect("localhost","root","","jhamobi_assessment");

    $SetId = $_REQUEST['varname'];

    $res1 = mysqli_query($conn, "SELECT * FROM questionset s WHERE s.quesSetId = $SetId");
    // now there is list of all the questions in the list.


    while ($rows = mysqli_fetch_assoc($res1)){
        $gradeName = $rows['gradeName'];
        $subName = $rows['subjectName'];

        $list = explode(",",$rows['quesIdList']);
        $finallist = array ();
        for ($x = 0; $x < sizeof($list)-1; $x++) {
            array_push($finallist, intval($list[$x]));
        }
        //print_r($finallist);
    }

    

    for ($x = 0; $x < sizeof($list)-1; $x++) {
        mysqli_query($conn, "INSERT INTO temp VALUES($finallist[$x])");
    }



    $res = mysqli_query($conn, "SELECT * FROM question q, questionset s, temp t WHERE s.quesSetId = $SetId AND t.ques_id = q.questionID");

    mysqli_query($conn, "TRUNCATE TABLE temp");

    if (mysqli_num_rows($res) > 0){
        $html ='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Question Paper</title>

            <style>
                *{
                    background-color : color:rgb(223, 223, 210);
                }
                h2 ,.dura{
                    font-family: Helvetica, Arial, sans-serif;
                    font-weight: 400;
                    overflow-x: hidden;
                    overflow-y: auto;
                    margin-right: 1.5em;
                    margin-left: 1.5em;
                }
                .timing {
                    display: flex;
                    flex-direction: row; 
                    justify-content: space-between; 
                    align-items: center; 
                }

                


                h1{
                    font-size : 1.8em;
                    font-family : sans-serif;
                    text-align : center;
                    color : white;
                    background-color : rgb(70, 196, 227);
                }

                p{
                    font-family: Helvetica, Arial, sans-serif;
                    font-weight: 400;
                    margin-right: 1.5em;
                    margin-left: 1.5em;
                }
                
                table{
                    font-size : 1.2em;
                    border-collapse : collapse;
                    width : 100%;
                    font-family : sans-serif;
                    margin-right: 1.5em;
                    width: calc(100% - 50px);
                    margin-right: 25px; 
                    margin-left: 25px; 

                }

                td, th {
                    border-color: #96D4D4;
                    text-align : center;
                }

                
                tr:nth-child(odd) {
                    background-color: gainsboro;
                }
                th , tr{
                    height : 50px;
                }
                th{
                    background-color : white;
                }

            </style>
        </head>
        <body>

            <h1>JhaMobi Technologies Private Limited</h1>

            <div class = "timing">
                <h2 class = "dura"  >Date : ';
            
            $html .= date('d-m-Y');

            $html .= '
                </h2>
                <h2 class = "dura" >Duration : 3hrs.</h2>
                <h2 class = "dura" > Subject : 
                ';
                $html .= $subName;
                $html .= '
                </h2>
                <h2 class = "dura" > Grade : 
                ';
                $html .= $gradeName;
                $html .= '
                    </h2>
                    </div>

                <div class = "instruction">
                    <p>General Instructions :</p>
                    <p>1. All questions are compusory.</p>
                    <p>2. Basic difficulty question carries 6 marks. <br></p>
                    <p>3. Medium difficulty question carries 10 marks.<br>
                    <p>4. Hard difficulty question carries 15 marks.</p>
                </div>
                ';


                
                $html .= '
                
                <table>
                <thead>
                <tr>
                <th>Q No. </th>
                <th>Q NAME</th>
                <th>Difficulty</th>
                </tr>
                </thead>
                <tbody>
                
        ';
        $qno = 1;
        while ($row = mysqli_fetch_assoc($res)){
            $html .= '<tr><td>'.$qno.'</td><td>'.$row['questionText'].'</td><td>'.$row['complexityLevel'].'</td></tr>';
            $qno = $qno + 1;
        }

        $html.= '</tbody>
                </table>
                <br><br>

                
                <h3 style = "text-align :center;font-size : 1.2em;
                font-family : sans-serif" >************** END **************</h3>
                
                </body>
                </html>';
        //echo $html;

        $obj = new Dompdf();
        $obj->loadHTML($html);
        $obj->render();

        // $f;
        // $l;
        // if(headers_sent($f,$l))
        // {
        //     echo $f,'<br/>',$l,'<br/>';
        //     die('now detect line');
        // }
        $obj->stream();
    }else {
        $html = "Data not Found :: ";

    }

    

    
?>

