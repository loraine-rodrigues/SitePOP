<?php

echo '
    </main>
    <footer class="footer mt-auto py-3 text-center bg-dark">
      <div class="container">
        <span class="text-white-50">&copy; 2019 - POP!</span>
      </div>
    </footer>
    <script>
        $(document).ready(function() {
            $(\'a[href="\' + this.location.pathname + \'"]\').parent().addClass(\'active\');
        });
    </script>
</body>
</html>';