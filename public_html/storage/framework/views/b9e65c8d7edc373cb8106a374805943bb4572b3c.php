<?php $__env->startSection('header'); ?>

User Management / การจัดการผู้ใช้งาน

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>







<!--**********************************

    Content body start

***********************************-->

<div class="content-body ">

    <!-- row -->

    <div class="container-fluid">

        <div class="row">

            <div class="col-xl-12">

                <div class="card">

                    

                    <div class="card-body">

                        <!-- Nav tabs -->

                        <div class="custom-tab-1 d-flex justify-content-between">

                            <ul class="nav nav-tabs">

                                <li class="nav-item">

                                    <a class="nav-link active" data-toggle="tab" href="#home1">All User<br>ผู้ใช้ทั้งหมด</a>

                                </li> 

                            </ul>

                            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-outline-primary">Add New User<br>เพิ่มผู้ใช้ใหม่</a>

                        </div>

                    </div>

                </div>

            </div>



            

                <div class="col-md-12">

                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="home1" role="tabpanel">

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="card">

                                        

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table class="table table-responsive-sm">

                                                    <thead>

                                                        <tr>

                                                            <th><strong>USER<br>ผู้ใช้</strong></th>

                                                            <th><strong>ROLE<br>ตำแหน่ง,หน้าที่</strong></th>

                                                            <th><strong>CREATE DATE</strong></th>

                                                            <th><strong>ACTION</strong></th>

                                                            

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <?php if(!empty($user)): ?>

                                                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <tr>

                                                                <td>

                                                                    <div class="d-flex align-items-center justify-content-center">

                                                                        <img src="<?php echo e(!empty($value->image) ? asset('storage/'.$value->image) : '/assets/images/avatar/1.jpg'); ?>" class="rounded-lg mr-2" width="24" alt=""/> 

                                                                        <span class="w-space-no"><strong><?php echo e($value->name); ?></strong></span>

                                                                    </div>

                                                                </td>

                                                                <td class="text-dark">

                                                                    <?php if(!empty($value->role)): ?>

                                                                        

                                                                    <?php $__currentLoopData = json_decode($value->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                    <?php echo e($item); ?>,

                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                    <?php else: ?>

                                                                    N/A

                                                                    <?php endif; ?>

                                                                </td>

                                                                <td><?php echo e(date_format($value->created_at,'D ,d M Y h:i A')); ?></td>

                                                                <td>

                                                                    <div class="d-flex align-items-center justify-content-center">

                                                                        <a href="<?php echo e(route('users.edit',$value->id)); ?>" class="btn btn-primary shadow px-3 sharp mr-1">Edit / แก้ไข</a>

                                                                        <a href="<?php echo e(route('users.destroy',$value->id)); ?>" onclick="return confirm('Are you Sure?')" class="btn btn-danger shadow  sharp">Delete / ลบ</a>

                                                                    </div>

                                                                </td>

                                                            </tr>

                                                                

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php endif; ?>

                                                        

                                                      

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            

            

        </div>

    </div>

</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/users/index.blade.php ENDPATH**/ ?>