<?php

echo '
    </main>
    
    <footer class="mt-auto p-3 text-center bg-light" >
    
      <div class="container ">
        <span class="text-dark-50";   >&copy; 2019 - POP!</span>
        
      </div>
    
      <div class="container-fluid bg-light mt-3">
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
    </footer>
    
    <script>
        $(document).ready(function() {
            $(\'a[href="\' + this.location.pathname + \'"]\').parent().addClass(\'active\');
        });
    </script>
</body>
</html>';
