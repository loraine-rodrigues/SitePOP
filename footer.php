<?php

echo '
    </main>
    
    <footer class="mt-auto p-3 text-center bg-light" >
    
      <div class="container ">
        <span class="text-dark-50";   >&copy; 2019 - POP!</span>
        
      </div>
    
      <div class="container-fluid bg-light">
      <ul class="nav justify-content-center">
      <li>
                  <a class="text-dark m-3" href="/duvidas.php">Dúvidas Frequentes</a>
                </li>
      <li>
        <a class="text-dark m-3" href="sobreNos.php">Sobre nós</a>
      </li>
      <li>
      <a class="text-dark m-3" href="termos.php">Termos de uso</a>
      </li>
      
      </div> 
    </footer>
    
    <script>
        $(document).ready(function() {
            $(\'a[href="\' + this.location.pathname + \'"]\').parent().addClass(\'active\');
        });
    </script>
</body>
</html>';
