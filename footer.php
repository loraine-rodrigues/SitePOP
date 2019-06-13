</main>

<footer class="mt-auto p-3 text-center bg-light">
    <div class="container bg-light">
        <span class="text-dark-50">&copy; 2019 - POP!</span>

        <ul class="nav justify-content-center">

            <li>
                <a class="text-dark m-3" href="/duvidas.php">Dúvidas Frequentes</a>
            </li>
            <li>
                <a class="text-dark m-3" href="/sobreNos.php">Sobre nós</a>
            </li>
            <li>
                <a class="text-dark m-3" href="/termos.php">Termos de uso</a>
            </li>
        </ul>
    </div>
</footer>

<script>
    $(document).ready(function () {
        if (this.location.pathname.includes('perfil')) {
            $('a[href*="/perfil"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('catalogo')) {
            $('a[href*="/catalogo.php"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('comoFunciona')) {
            $('a[href*="/comoFunciona.php"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('contato')) {
            $('a[href*="/contato.php"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('admin/motofretistas')) {
            $('a[href*="/admin/motofretistas"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('admin/clientes')) {
            $('a[href*="/admin/clientes"]').parent().addClass('active');
        }
    });
</script>
</body>
</html>
