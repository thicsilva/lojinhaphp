        <footer class="footer">
            <div class="footer-copyright">Lojinha &copy; <?=date('Y')?></div>
            <div class="footer-signature">Desenvolvido com 🧡 por <a href="//github.com/thicsilva">@thicsilva</a></div>
        </footer>
    </div>
    <?php if (isset($datatableJs)): ?>
    <script src="<?=$datatableJs?>"></script>
    <?php endif?>
    <script src="<?=$base?>/assets/js/admin.js"></script>
</body>
</html>
