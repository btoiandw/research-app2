<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RDI-KPRU</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
        }


        h1,
        p,
        h2,
        h3,
        h4,
        ul,
        li,
        div {
            margin: 0;
            padding: 0;
        }


        body {
            padding: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            display: flex;
            font-family: 'Sarabun', sans-serif;
        }


        .loading-page {
            background: #009EFF;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;

            /* align-items: center;  */
        }

        .counter {
            text-align: center;
            top: 25%;
        }

        p {
            font-size: 50px;
            font-weight: 100;
            color: #ffffff;
        }

        h5 {
            color: white;
            font-size: 20px;
            margin-top: 10px;
        }

        img {
            width: 150px;
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 30px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #fff;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }


        hr {
            background: red;
            border: none;
            height: 5px;
        }

        .counter {
            position: relative;
            width: 500px
        }

        h5.abs {
            position: absolute;
            top: 0;
            width: 100%
        }

        .color {
            width: 0px;
            overflow: hidden;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="loading-page">
        <div class="counter">
            <p>
                <img src="https://scitech.kpru.ac.th/prscitech/uploads/20151116162055.png" alt="logo">
            </p>
            <h5>กรุณารอสักครู่กำลังประมวลผล...0%</h5>

            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            var counter = 0;
            var c = 0;
            var i = setInterval(function() {
                $(".loading-page .counter h5").html("กรุณารอสักครู่กำลังประมวลผล..." + c + "%");
                //$(".loading-page .counter hr").css("width", c + "%");
                $(".loading-page .counter .loader").css("width", c + "%")
                //$(".loading-page .counter").css("background", "linear-gradient(to right, #f60d54 "+ c + "%,#0d0d0d "+ c + "%)");

                /*
                $(".loading-page .counter h1.color").css("width", c + "%");
                */
                counter++;
                c++;

                if (counter == 101) {
                    clearInterval(i);
                    window.location.replace('login');
                }
            }, 50);
        });
    </script>
</body>

</html>
