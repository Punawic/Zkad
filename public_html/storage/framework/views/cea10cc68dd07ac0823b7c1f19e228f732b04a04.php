<?php $__env->startSection('header'); ?>
  User Settings / การตั้งค่าผู้ใช้งาน
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile / โปรไฟล์</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="<?php echo e(route('setting.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>USER NAME / ชื่อผู้ใช้งาน</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo e(Auth::user()->name); ?>" required placeholder="Eneter User Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>EMAIL</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo e(Auth::user()->email); ?>" required readonly placeholder="Enter email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php if(!empty(Auth::user()->image)): ?>
                                           <img src="<?php echo e(asset('storage/'.Auth::user()->image)); ?>" width="100px" alt=""> 
                                        <?php endif; ?>
                                        <label>Image / เลือกรูปภาพโปรไฟล์*</label>
                                        <input type="file" class="form-control" name="image" >
                                    </div>
                                                                       
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-success">Update / อัปเดตข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Password Setting / ตั้งค่ารหัสผ่าน</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="<?php echo e(route('setting.password')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">
                                         
                                    <div class="form-group col-md-12">
                                        <label>Old Password / รหัสผ่านเก่า</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="ใส่ รหัสผ่านเก่า">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>New Password / รหัสผ่านใหม่</label>
                                        <input type="password" class="form-control" name="new_password"  placeholder="ใส่ รหัสผ่านใหม่">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Confirm Password / กรอกรหัสผ่านใหม่อีกครั้ง</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="ใส่ รหัสผ่านใหม่อีกครั้ง">
                                    </div>
                                    
                                   
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-success">Update / อัปเดตข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/setting.blade.php ENDPATH**/ ?>