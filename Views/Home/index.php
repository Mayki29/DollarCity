<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header.php");
?>

<div class="slider">
    <input type="radio" name="slider" checked>
    <div class="imgBox">
        <img src="<?=$url_host?>assets/img/4.jpg" alt="Error al cargar imagen">
        <div class="contenido">
            <h1>Calidad y Variedad</h1>
            <p>En Dollarcity, creemos que la vida es mejor cuando tienes acceso a los mejores productos. Nuestros
                pasillos están llenos de opciones frescas y deliciosas para satisfacer todos tus gustos y necesidades.
            </p>
            <a href="#">Saber más</a>
        </div>
    </div>
    <input type="radio" name="slider">
    <div class="imgBox">
        <img src="<?=$url_host?>assets/img/2.jpg" alt="Error al cargar imagen">
        <div class="contenido">
            <h1>Ahorra en Grande</h1>
            <p>En Dollarcity, entendemos lo valioso que es tu tiempo y dinero. Te ofrecemos la conveniencia de hacer tus
                compras de manera eficiente y económica, para que puedas disfrutar de lo que realmente importa en la
                vida.</p>
            <a href="#">Saber más</a>
        </div>
    </div>
    <input type="radio" name="slider">
    <div class="imgBox">
        <img src="<?=$url_host?>assets/img/3.jpg" alt="Error al cargar imagen">
        <div class="contenido">
            <h1>Ofertas Inigualables</h1>
            <p>En cada visita, te sorprenderás con nuestras increíbles ofertas y promociones. En Dollarcity, no solo
                obtendrás productos de alta calidad, sino también increíbles ahorros que te harán sonreír.</p>
            <a href="#">Saber más</a>
        </div>
    </div>
</div>

<div class="content-container">
    <div class="title"><a class="title_text">Conoce nuestras categorías</a></div>
    <div class="categories">
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat1.jpg" alt="Categoría 1">
            <p>Temporada</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat2.jpg" alt="Categoría 2">
            <p>Cocina</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat3.jpg" alt="Categoría 3">
            <p>Hogar</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat4.jpg" alt="Categoría 4">
            <p>Cuidado Personal</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat5.jpg" alt="Categoría 5">
            <p>Manualidades</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat6.jpg" alt="Categoría 6">
            <p>Juguetes</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat7.jpg" alt="Categoría 7">
            <p>Limpieza</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat8.jpg" alt="Categoría 8">
            <p>Celebraciones</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat9.jpg" alt="Categoría 9">
            <p>Mascotas</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat10.jpg" alt="Categoría 10">
            <p>Oficina</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat11.jpg" alt="Categoría 11">
            <p>Alimentos</p>
        </div>
        <div class="category">
            <img src="<?=$url_host?>assets/img/cat12.jpg" alt="Categoría 12">
            <p>Bebé</p>
        </div>
    </div>
</div>
<?php include("./Views/Layouts/footer.php") ?>