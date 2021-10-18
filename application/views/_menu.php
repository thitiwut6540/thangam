<ul>
    <li><a href="<?php echo base_url(); ?>"><div class="btn_non_dropdown"><i class="fas fa-home fa-fw"></i> หน้าแรก</div></a></li>
    <?php for($x = 1; $x <= 9; $x++) {?>
    <li class="">
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-list-ul fa-fw"></i> ข้อมูลเทศบาล</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <a href="#">ต้วอย่างเมนู 1</a>
                <a href="#">ต้วอย่างเมนู 2</a>
                <a href="#">ต้วอย่างเมนู 3</a>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>