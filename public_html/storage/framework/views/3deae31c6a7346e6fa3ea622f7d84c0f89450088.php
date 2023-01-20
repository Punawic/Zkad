<?php $__env->startSection('header'); ?>

Income/ รายรับ

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-body">

    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                

                    <div class="col-md-8">

                        <h6 class="card-title">Please enter the advertising cost of that page each day. (select previous day)<br>กรุณากรอกค่าโฆษณาของเพจนั้นในแต่ละวัน (เลือกวันก่อนหน้า)</h6>

                    </div>

                    <div class="col-md-4">

                        <form action="<?php echo e(route('income.export_excel')); ?>" class="form form-inline" method="POST">

                            <?php echo csrf_field(); ?>

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2023 - 12/31/2023">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                

            </div>

            <div class="card-body">

                <div class="basic-form">

                    <form action="<?php echo e(route('income.store')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group col-md-6">

                                    <label><b>Sale for / เลือกยอดวันที่</b></label>

                                    <input type="date" class="form-control" name="date" required placeholder="day/month/year">

                                </div>


                                    <hr width="100%" size="3" align="center" color="green" noshade>


                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label><b>Income / รายรับ</b></label>

                                        <input type="number" class="form-control" name="income" required value="" placeholder="รายรับ">

                                    </div>

                                    

                                </div>

                            </div>



                            <div class="col-md-6 align-self-end mb-3">

                                <button type="submit" class="btn btn-success">ADD / เพิ่ม</button>

                            </div>                    

                        </div>

                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header">

                <h4 class="card-title">BILL TABLE </h4>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-responsive-md">

                        <thead>

                            <tr>

                                <th>DATE / วันที่</th>
                                
                                <th>INCOME / รายรับ</th>

                                <th>Execute(Delete) / ลบข้อมูล</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $income; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                                <tr>

                                    <?php

                                        $date = date('d/m/Y', strtotime($value->date))

                                    ?>

                                    <th><?php echo e($date); ?></th>

                                    <td><?php echo e($value->income); ?></td>

                                    <td><a href="<?php echo e(route('income.destroy',$value->id)); ?>" onclick="return confirm('Are you Sure?')" class="text-danger">delete</a></td>

                                </tr>

                                
                            


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="5" class="text-center">Not Available</td>

                            </tr>

                            <?php endif; ?>

                          

                          

                        </tbody>

                    </table>

                </div>

                <div class="row mt-3">

                    <div class="col-md-12 text-right">

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/income/index.blade.php ENDPATH**/ ?>