<!-- header.php -->
<!DOCTYPE html>
<html>
<head>
    <title>MedExpress Pharmacy Supply</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #e8f6f9; 
        }


        .top-banner {
            width: 100%;
            height: 40vh;              
            max-height: 500px;         
            background-color: #b7e3ea;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 3px solid #8fc8d1;
            overflow: hidden;
        }

        .top-banner img {
            width: 100%;               
            height: 100%;              
            object-fit: cover;         
        }

        .main-title {
            text-align: center;
            background-color: #d4f2f6;
            padding: 15px;
            font-size: 26px;
            font-weight: bold;
            color: #156e75;
            border-bottom: 2px solid #9bd3d8;
        }

        .content-area {
            width: 90%;
            margin: auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th {
            background-color: #a9dee5;
            color: #03484d;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #d6edf0;
        }

        .form-box {
            background: #f0fbfd;
            border: 1px solid #9bd3d8;
            padding: 15px;
            margin-top: 20px;
            border-radius: 6px;
        }

        input[type=text], input[type=number] {
            padding: 8px;
            width: 95%;
            margin-top: 8px;
            border: 1px solid #8fc8d1;
            border-radius: 4px;
        }

        input[type=submit] {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #7cc7d0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-weight: bold;
        }

        input[type=submit]:hover {
            background-color: #5daeb5;
        }

        .result-box {
            background: #dff7fa;
            border-left: 4px solid #4daab4;
            padding: 10px;
            margin-top: 15px;
        }

        @media (max-width: 480px) {
            .top-banner {
                height: 30vh;
            }
        }
    </style>
</head>
<body>

<div class="top-banner">
    <img src="img/Banner 2.png" alt="Banner Image Placeholder">
</div>

<div class="main-title">
    MedExpress Pharmacy Inventory Supply
</div>

<div class="content-area">

