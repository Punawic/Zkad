<?php $__env->startSection('header'); ?>

  User Management

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

                        <h4 class="card-title"><?php echo e(isset($user) ? 'Update' : 'Create New'); ?> User / สร้าง USER ใหม่</h4>

                    </div>

                    <div class="card-body">

                        <div class="basic-form">

                            <form action="<?php echo e(isset($user) ? route('users.update',$user->id) : route('users.store')); ?>" method="POST">

                                <?php echo csrf_field(); ?>

                                <?php if(isset($user)): ?>

                                    <?php echo method_field('put'); ?>

                                <?php endif; ?>

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label>USER NAME</label>

                                        <input type="text" class="form-control" name="username" value="<?php echo e(isset($user) ? $user->name : ''); ?>" required placeholder="ใส่ username">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>EMAIL</label>

                                        <input type="email" class="form-control" name="email" value="<?php echo e(isset($user) ? $user->email : ''); ?>" required placeholder="ใส่ email">

                                    </div>

                                    <?php if(!isset($user)): ?>

                                        

                                    <div class="form-group col-md-12">

                                        <label>Password</label>

                                        <input type="password" class="form-control" name="password" required placeholder="ใส่รหัสผ่าน">

                                    </div>

                                    <div class="form-group col-md-12">

                                        <label>Confirm Password</label>

                                        <input type="password" class="form-control" name="confirm_password" required placeholder="ใส่รหัสผ่านอีกครั้ง">

                                    </div>

                                    <?php endif; ?>

                                    <div class="form-group col-md-12">

                                        

                                    <h3>Roles / หน้าที่</h3>

                                    </div>

                                    <div class="form-group col-md-12">

                                        











                                    <input type="checkbox"

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>     

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Page' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                       <?php endif; ?>

                                    name="role[]" value="Page" id="page" class="users">

                                    <label for="page">Page</label>

                                    <br>


                                    <input type="checkbox"

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>     

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Cashflow' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                       <?php endif; ?>

                                    name="role[]" value="Cashflow" id="cashflow" class="users">

                                    <label for="cashflow">Cashflow</label>

                                    <br>


                                    <input type="checkbox"

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>     

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Shipping' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                       <?php endif; ?>

                                    name="role[]" value="Shipping" id="shipping" class="users">

                                    <label for="shipping">Shipping</label>

                                    <br>



                                    <input type="checkbox"

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>  

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Campaign' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    name="role[]" value="Campaign" id="campaign" class="users">

                                       

                                    <label for="campaign">Campaign</label>

                                    <br>



                                    <input type="checkbox" 

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>  

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Sale' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    name="role[]" value="Sale" id="sale" class="users">

                                       

                                    <label for="sale">Sale</label>

                                    <br>


                                    <input type="checkbox" 

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>  

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Advertising' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    name="role[]" value="Advertising" id="advertising" class="users">

                                       

                                    <label for="advertising">Advertising</label>

                                    <br>


                                    <input type="checkbox" 

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>  

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Delivery' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    name="role[]" value="Delivery" id="delivery" class="users">

                                       

                                    <label for="delivery">Delivery</label>

                                    <br>



                                    <input type="checkbox" 

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>  

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Return Percent' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    name="role[]" value="Return Percent" id="return-percent" class="users">

                                       

                                    <label for="return-percent">Return Percent</label>

                                    <br>



                                    <input type="checkbox" 

                                        <?php if(isset($user)): ?>

                                            <?php if(!empty($user->role)): ?>  

                                                <?php $__currentLoopData = json_decode($user->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php echo e($item== 'Admin' ? 'checked' : ''); ?>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    name="role[]" value="Admin" id="admin" class="admin">

                                       

                                    <label for="admin">Admin</label>

                                    <br>

                                    

                                    </div>

                                    <div class="col-md-12 text-right">

                                        <button type="submit" class="btn btn-success"><?php echo e(isset($user) ? 'Update' : 'Save'); ?></button>

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





<?php $__env->startSection('js'); ?>

<script>

    var adminBox = document.querySelector('.admin');

    var usersBoxs = document.querySelectorAll('.users');



    adminBox.addEventListener('change', () => {

        if(adminBox.checked) {

            usersBoxs.forEach(box => {

            if(box.checked) {

                box.checked = false;

            }

        });

        }

    });



</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/users/create.blade.php ENDPATH**/ ?>