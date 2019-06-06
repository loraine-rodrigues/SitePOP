<?php

echo '
    </main>
    
    <footer class="mt-auto py-3 text-center bg-light" >
    
      <div class="container ">
        <span class="text-dark-50";   >&copy; 2019 - POP!</span>
        
      </div>
    
          
    </footer>
    <div class="container-fluid bg-light ">
    <ul class="list-unstyled ">
    <li>
                <a class="text-dark" href="/duvidas.php">Dúvidas Frequentes</a>
              </li>
    <li>
      <a class="text-dark" href="sobreNos.php">Sobre nós</a>
    </li>
    <ul class="list-unstyled">
    <li>
    <a class="text-dark" href="termos.php">Termos de uso</a>
    </li>
    
    </div> 
    <script>
        $(document).ready(function() {
            $(\'a[href="\' + this.location.pathname + \'"]\').parent().addClass(\'active\');
        });
    </script>
</body>
</html>';
