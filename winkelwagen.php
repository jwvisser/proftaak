<?php

use smartcaps\db;
use smartcaps\translate;

include("components/header.php");

$language = new smartcaps\translate();
$db = new smartcaps\db();
?>

    <style>
        .container-grid{
            display:grid;
            grid-template-columns: auto auto auto;
            grid-column-gap: 5px;
            grid-row-gap:10px;
        }

        @media screen and (max-width: 1500px) {
            .container-grid{
                grid-template-columns: auto auto auto;
            }
        }

        /* On screens that are 600px wide or less, make the columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 1200px) {
            .container-grid{
                grid-template-columns: auto auto;
            }
        }

        @media screen and (max-width: 992px) {
            .container-grid{
                grid-template-columns: auto auto auto;
            }
        }

        /* On screens that are 600px wide or less, make the columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .container-grid{
                grid-template-columns: auto auto;
            }
        }

        .container-grid .product{
            background-image: url('https://via.placeholder.com/300');
            width:300px;
            height:300px;
            text-align:center;

            position:relative;
        }

        .product .title{
            background-color: white;
            width: -webkit-fill-available;
            height: 30px;
            padding: 10px;
            position: absolute;
            top: -20px;
            border:1px solid black;
        }

        .product .price{
            position: absolute;
            top: 100px;
            left: 0;
            bottom: 0;
            right: 0;
            margin: auto;
        }

        .product button.removeButton{
            background-color: #611D6A;
            color:white;
            font-weight:bold;
            text-transform: uppercase;
            width: -webkit-fill-available;
            height:35px;
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            margin: auto;
        }

        #pricetable{
            position:absolute;
            top:0;
            right: -10%;
            z-index:999;

            border:1px solid black;
            padding:15px;
        }

    </style>
    <div class="container-grid">
        <?php echo $db->returnProducts(); ?>
    </div>
    <script>
        var products = Cookies.get('cart');

        if(products == undefined){

        }else{
            var productsArray = products.split(',');
        }

        function removeProduct(id) {
            var products = Cookies.get('cart');
            var productsArray = products.split(',');
            productsArray.splice($.inArray(id, productsArray), 1);
            productsArray = productsArray.toString();
            Cookies.set('cart', productsArray);
            $('#removeButton'+id).hide();
            $('#removeButton'+id).closest('div.product').hide();
            toastr.warning('Product verwijdert uit winkelwagen');
            location.reload();
        }
    </script>

<?php include("components/footer.php"); ?>