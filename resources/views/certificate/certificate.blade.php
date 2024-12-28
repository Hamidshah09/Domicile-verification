<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Domicile Verification Certificate</title>
    {{-- <link rel="stylesheet" href="{{asset('build/assets/app-BETWqZgd.css')}}"> --}}
</head>
<style>
    @font-face {
    font-family: "Poppins";
    src: url("../google-fonts/Poppins-Regular.ttf") format("truetype"),
        url("../google-fonts/Poppins-Bold.ttf") format("truetype"),
        url("../google-fonts/Poppins-ExtraBold.ttf") format("truetype"),
        url("../google-fonts/Poppins-ExtraLight.ttf") format("truetype"),
        url("../google-fonts/Poppins-Medium.ttf") format("truetype");
    font-weight: normal;
    font-style: normal;
    }
    *{
        font-family: "Poppins",sans-serif;
    }
    .wraper{
        margin-top:20px; 
    }
    .w-100{
        width: 100%
    }
    .text-center{
        text-align: center;
    }
    .text-bold{
        font-weight: 700;
    }
    .inline{
        display: inline;
    }
    .f-right{
        float: right;
    }
    .mr-3{
        margin-right: 20px;
    }
    .ml-3{
        margin-left: 20px;
    }
    .ml-5{
        margin-left: 100px;
    }
    .ml-6{
        margin-left: 110px;
    }
    .ml-7{
        margin-left: 60%;
    }
    .mt-2{
        margin-top: 15px;
    }
    .mt-3{
        margin-top: 40px;
    }
    .ul{
        text-decoration: underline;
    }
    .tab{
        padding-right: 50px;
        display: inline;
    }
    .sign{
        width: 150px;
        height: 100px;
    }
</style>
<body>
    <div class="wrapper w-100">
        <div class="w-100 text-center text-bold">GOVERNMENT OF PAKISTAN</div>
        <div class="w-100 text-center text-bold">OFFICE OF THE DEPUTY COMMISSIONER</div>
        <div class="w-100 text-center text-bold">ISLAMABAD CAPITAL TERRITORY</div>
        <div class="w-100 mt-2">
            <div class="inline ml-3">No.123/CFC/Domicile</div>
            <div class="inline f-right mr-3">Dated: {{\Carbon\Carbon::now()->toDateString()}}</div>
        </div>
        <div class="w-100 ml-3 mt-2 text-bold ul text-center">
            TO WHOM IT MAY CONCERN
        </div>
        <div class="ml-3 mt-2"><span class="tab"></span>It is verified that Domicile No. __________ dated __________ is issued to Mr._______ s/o _______ from this office.</div>
        <div class="ml-7 mt-3 text-center">
            <img class="sign" src="{{asset('images/signature.jpeg')}}" alt=""> 
            <div class="text-bold">Assistant Commissioner(Saddar)</div>
            <div class="text-bold">Islamabad</div>
        </div>
    </div>
    
</body>
</html>