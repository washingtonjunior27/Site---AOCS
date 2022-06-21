<?php
ob_start();
require_once 'includes/header.php';
?>

<!-- SECTION 1 - MAIN SECTION -->
<section id="inicio" class="d-flex flex-column justify-content-center align-items-center text-white">
    <div class="container">
        <div class="mask mask-custom" style="height: 100vh;">
            <div class="mt-5 text-center d-flex flex-column justify-content-center align-items-center h-100">
                <h1 class="text-uppercase fw-bold w-75">AOCS - Bot Comercial</span></h1>

                <p class="w-75"> Clique no icone abaixo para obter acesso ao bot.</p>
                <a href="https://wa.me/5592991682294" target="_blank">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/sobre.php';
require_once 'includes/duvidas.php';
require_once 'includes/garantias.php';
require_once 'includes/discussao.php';
require_once 'includes/footer.php';
ob_end_flush();
?>