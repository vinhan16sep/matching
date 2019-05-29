</div>
<!-- End of Main Content -->
<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('admin')): ?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Bản quyền thuộc về &copy; <a href="http://www.vinasa.org.vn/" target="_blank">Vinasa</a> <?php echo date('Y') ?></span>
        </div>
    </div>
</footer>
<?php endif; ?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('admin/user/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>



<!-- Page level plugins -->
<!--<script src="--><?php //echo site_url('assets/'); ?><!--vendor/chart.js/Chart.min.js"></script>-->
<!--<!-- Page level custom scripts -->
<!--<script src="--><?php //echo site_url('assets/'); ?><!--js/demo/chart-area-demo.js"></script>-->
<!--<script src="--><?php //echo site_url('assets/'); ?><!--js/demo/chart-pie-demo.js"></script>-->

</body>

</html>