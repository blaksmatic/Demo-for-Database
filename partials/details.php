<div ng-controller="detailController">
    <div class="row">

        <?php
        include "../public/parse_all_info.php";
        $assignment = new parse_all_info();
        ?>
        <script type="text/javascript">
            var assignment = <?php echo json_encode($assignment) ?>;
        </script>

            <h1>You are in details now</h1>

    </div>
</div>