<ul class="list-group">
    <li class="list-group-item active">1. ข้อมูลผู้ยื่นคำร้อง บันทึกเบอร์โทรศัพย์เพิ่มเติม </li>
    <li class="list-group-item ">ชื่อ - สกุล : <?php echo $this->session->userdata('name') . " " . $this->session->userdata('lname'); ?></li>
    <li class="list-group-item">เลขบัตรประชาชน : <?php echo $this->session->userdata('cid') ?></li>
    <li class="list-group-item "> เบอร์โทร : <input type="text" class="form-control" id="mobile" name="mobile" placeholder="เบอร์โทร"> </li>
</ul>
<br>
<ul class="list-group">
    <li class="list-group-item active">2. Download เอกสารเพื่อลงลายมือชื่อ</li>
    <li class="list-group-item">Item</li>
    <li class="list-group-item disabled">Disabled item</li>
</ul>
<br>
<div class="card">
    <div class="card-header">
        3. ยื่นเอกสารหลังลงลายมือชื่อ
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">Active item</a>
            <a href="#" class="list-group-item list-group-item-action">Item</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Disabled item</a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3 row">
            <label for="formFile" class="form-label"></label>
            <input class="form-control" type="file" id="formFile">
        </div>
    </div>
</div>