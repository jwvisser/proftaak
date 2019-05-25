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
        grid-template-columns: auto auto auto auto;
        grid-column-gap: 5px;
        grid-row-gap:10px;
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

    .product button{
        background-color: #FFB200;
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
    .product button:disabled{
        background-color: lightgray;
        color:black;
        border:1px solid #611D6A;
    }
</style>
<a href="./winkelwagen">Naar winkelwagen ></a><br><br>
<div class="container-grid">
    <?php echo $db->returnProducts(); ?>
</div>
<a onclick="Cookies.remove('cart');">unset cookie</a>
<script>
    var products = Cookies.get('cart');

    if(products == undefined){
        Cookies.set('cart', "");
        location.reload();
    }else{
        var productsArray = products.split(',');
        productsArray.forEach(function(id) {
            $('#addToCart'+id).text("Product toegevoegd");
            $('#addToCart'+id).attr("onclick","removeProduct("+id+")");
        });
    }

    function addProduct(id){
        var products = Cookies.get('cart');
        var productsArray = products.split(',');
        console.log(productsArray);
        element = ''+id+'';
        productsArray.push(element);
        productsArray = productsArray.toString();
        Cookies.set('cart', productsArray);
        $('#addToCart'+id).text("Product toegevoegd");
        $('#addToCart'+id).attr("onclick","removeProduct("+id+")");
        toastr.success('Product toegevoegd aan winkelwagen')
    }

    function removeProduct(id){
        var products = Cookies.get('cart');
        var productsArray = products.split(',');
        productsArray.splice($.inArray(id, productsArray), 1);
        // productsArray.splice( productsArray.indexOf(id), 1 );
        productsArray = productsArray.toString();
        Cookies.set('cart', productsArray);
        $('#addToCart'+id).text("koop nu!");
        $('#addToCart'+id).attr("onclick","addProduct("+id+")");
        toastr.warning('Product verwijdert uit winkelwagen')
    }
    console.log(productsArray);
</script>

<?php include("components/footer.php"); ?>