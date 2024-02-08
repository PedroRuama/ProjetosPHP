<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Deslizante Duplo</title>
    <style>
        /*=============
Adding tick marks
=========================*/
        .range-slider {
            flex: 1;
        }

        .sliderticks {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
        }

        .sliderticks span {
            display: flex;
            justify-content: center;
            width: 1px;
            height: 10px;
            background: #d3d3d3;
            line-height: 40px;
        }

        /*=============
End tick marks
=========================*/


        input[type="range"] {
            /* removing default appearance */
            -webkit-appearance: none;
            appearance: none;
            /* creating a custom design */
            width: 100%;
            cursor: pointer;
            outline: none;
            border-radius: 15px;
            /*  overflow: hidden;  remove this line*/

            /* New additions */
            height: 6px;
            background: #ccc;
        }

        /* Thumb: webkit */
        input[type="range"]::-webkit-slider-thumb {
            /* removing default appearance */
            -webkit-appearance: none;
            appearance: none;
            /* creating a custom design */
            height: 15px;
            width: 15px;
            background-color: #f50;
            border-radius: 50%;
            border: none;

            /* box-shadow: -407px 0 0 400px #f50; emove this line */
            transition: .2s ease-in-out;
        }

        /* Thumb: Firefox */
        input[type="range"]::-moz-range-thumb {
            height: 15px;
            width: 15px;
            background-color: #f50;
            border-radius: 50%;
            border: none;

            /* box-shadow: -407px 0 0 400px #f50; emove this line */
            transition: .2s ease-in-out;
        }

        /* Hover, active & focus Thumb: Webkit */

        input[type="range"]::-webkit-slider-thumb:hover {
            box-shadow: 0 0 0 10px rgba(255, 85, 0, .1)
        }

        input[type="range"]:active::-webkit-slider-thumb {
            box-shadow: 0 0 0 13px rgba(255, 85, 0, .2)
        }

        input[type="range"]:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 13px rgba(255, 85, 0, .2)
        }

        /* Hover, active & focus Thumb: Firfox */

        input[type="range"]::-moz-range-thumb:hover {
            box-shadow: 0 0 0 10px rgba(255, 85, 0, .1)
        }

        input[type="range"]:active::-moz-range-thumb {
            box-shadow: 0 0 0 13px rgba(255, 85, 0, .2)
        }

        input[type="range"]:focus::-moz-range-thumb {
            box-shadow: 0 0 0 13px rgba(255, 85, 0, .2)
        }

        /*=============
Aesthetics 
=========================*/

        body {
            font-family: system-ui;
        }

        h1 {
            color: #4b4949;
            text-align: center;
        }

        .wrapper {
            color: #4b4949;
            background: #f50;
            max-width: 400px;
            width: 100%;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        .range {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 500px;
            margin: 0 auto;
            height: 8rem;
            width: 80%;
            background: #fff;
            padding: 0px 10px;
        }

        .value {
            font-size: 26px;
            width: 50px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Custom range slider</h1>
    <div class="wrapper">
        <div class="range">
            <div class="range-slider">
                <label for="range">Select a pleasant temperature:</label><br />
                <input type="range" min="0" max="100" value="0" id="range"/>
                <div class="sliderticks">
                    <span>0</span>
                    <span>25</span>
                    <span>50</span>
                    <span>75</span>
                    <span>100</span>
                </div>
            </div>

            <div class="value">0</div>
        </div>
    </div>
    <script>
        
    </script>
</body>

</html>