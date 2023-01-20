<?php $__env->startSection('header'); ?>

Return Percent By Day / เปอร์เซนต์คืนรายวัน

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-body">

    <div class="container-fluid">



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header row">
                
                

                    <div class="col-md-6">

                        <h4 class="card-title">Choose the date and input the number below</h4>

                    </div>
                
                

            

                    <div class="col-md-6">

                        <form action="<?php echo e(route('percent_days.export_excel')); ?>" class="form form-inline" method="POST">

                            <?php echo csrf_field(); ?>

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="11/01/2022 - 12/31/2022">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                
            
            </div>

     


            <div class="card-body">

                <div class="basic-form">

                    <form action="<?php echo e(route('percent.store')); ?>" method="POST">

                        <?php echo csrf_field(); ?>
                        <div class="table-responsive">

                            <table class="table table-bordered table-responsive-md">

                            <thead>

                                <tr>

                                    <th><label>Choose The Date / เลือกวันที่</label></th>

                                </tr>

                            </thead>

                            <tbody>

                                    <tr>

                                        <td>

                                            <div class="form-group">

                                                <input type="date" class="form-control" name="return_date" placeholder="day/month/year" style="width: 270px">

                                            </div>
                                    
                                            </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-bordered table-responsive-md">

                                <thead>

                                    <tr>

                                        <th><label>Total Delivery Shipped<br>ยอดส่งวันที่</label></th>

                                        <th><label>Successful Shipped<br>เซ็นรับแล้ว</label></th>

                                        <th><label>In Inventory<br>พัสดุคงคลัง</label></th>

                                        <th><label>Returned Successful<br>พัสดุตีกลับ</label></th>

                                        <th><label>On the way Delivery<br>ระหว่างขนส่ง</label></th>

                                        <th><label>On the way Return<br>ระหว่างจัดการพัสดุ</label></th>

                                        <th><label>Damage&Claim<br>พัสดุเสียหาย</label></th>

                                        

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>

                                            <input type="number" class="form-control" required name="total_delivery_shipped">

                                        </td>

                                        <td>

                                            <input type="number" class="form-control" required name="successful_shipped">

                                        </td>

                                        <td>

                                            <input type="number" class="form-control" required  name="in_inventory">

                                        </td>

                                        <td>

                                            <input type="number" class="form-control" required name="returned_successful">

                                        </td>

                                        <td>

                                            <input type="number" class="form-control" required name="way_delivery">

                                        </td>

                                        <td>

                                            <input type="number" class="form-control" required name="way_return">

                                        </td>

                                        <td>

                                            <input type="number" class="form-control" required name="damage">

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>



                        <div class="row mt-2">

                            <div class="col-md-12 text-right">

                                <button type="submit" class="btn btn-primary btn-sm">ADD / เพิ่ม

                                    <span class="btn-icon-right"><i class="fa fa-plus"></i></span>

                                </button>

                            </div>

                        </div>



                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-body">

                <div class="basic-form">

                    <form>

                        <div class="table-responsive">

                            <table class="table table-bordered table-responsive-md table__day">

                                <thead>

                                    <tr>

                                        <th>Delivery Date<br>วันที่</th>

                                        <th><label class="mb-0">Total Delivery Shipped<br>ยอดส่งวันที่</label></th>

                                        <th><label class="mb-0">Successful Shipped<br>เซ็นรับแล้ว</label></th>

                                        <th><label class="mb-0">In Inventory<br>พัสดุคงคลัง</label></th>

                                        <th><label class="mb-0">Returned Successful<br>พัสดุตีกลับ</label></th>

                                        <th><label class="mb-0">On the way Delivery<br>ระหว่างขนส่ง</label></th>

                                        <th><label class="mb-0">On the way Return<br>ระหว่างจัดการพัสดุ</label></th>

                                        <th><label class="mb-0">Damage&Claim<br>พัสดุเสียหาย</label></th>

                                        <th>Return Percentage<br>% ตีคืน</th>

                                        <th>Execute(Delete)<br>ลบข้อมูล</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php $__empty_1 = true; $__currentLoopData = $percentDay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                        

                                    <tr>

                                        <td><strong><?php echo e(date_format(date_create($value->return_date),'d M Y')); ?></strong></td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->total_delivery_shipped); ?>">

                                        </td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->successful_shipped); ?>">

                                        </td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->in_inventory); ?>">

                                        </td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->returned_successful); ?>">

                                        </td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->way_delivery); ?>">

                                        </td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->way_return); ?>">

                                        </td>

                                        <td>

                                            <input type="text" class="form-control" readonly value="<?php echo e($value->damage); ?>">

                                        </td> 

                                        <td><?php echo e(number_format((float)(1 - ($value->successful_shipped/$value->total_delivery_shipped)) * 100, 2, '.', '')); ?>%</td>

                                        <td><a href="<?php echo e(route('percent.destroyByDay',$value->id)); ?>" onclick="return confirm('Are you Sure?')" class="text-danger">delete</a></td>

                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                    <tr>

                                        <td colspan="9" class="text-center">Not Available</td>

                                    </tr>

                                    <?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </form>

                </div>

            </div>

        </div>



    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/percent/index.blade.php ENDPATH**/ ?>