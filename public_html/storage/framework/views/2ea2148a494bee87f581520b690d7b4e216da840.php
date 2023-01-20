<?php $__env->startSection('header'); ?>

Sale / ยอดขาย

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-body">

    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                

                    <div class="col-md-6">

                        <h6 class="card-title">Create Sale Information below</h6>

                    </div>

                    <div class="col-md-6">

                        <form action="<?php echo e(route('sales.export_excel')); ?>" class="form form-inline" method="POST">

                            <?php echo csrf_field(); ?>

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2023 - 12/31/2023">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                

            </div>

            <div class="card-body">

                <div class="basic-form">

                    <form action="<?php echo e(route('sales.store')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label><b>Sale for / เลือกยอดวันที่</b></label>

                                    <input type="date" class="form-control" name="sale_date" required placeholder="day/month/year">

                                </div>


                                    <hr width="100%" size="3" align="center" color="green" noshade>


                                
                                <div class="form-group">

                                    <label><b>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</b></label>



                                    <select id="inputState" name="page_campaign_name" required class="form-control default-select">

                                        <?php $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php

                                                $page = \App\Models\Page::where('id',$item->page_id)->first();

                                            ?>

                                            <?php if(!empty($page)): ?> 

                                               <option value="<?php echo e($page->id); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?>"><?php echo e($page->name); ?> = <?php echo e($item->campaign_name); ?> = <?php echo e($item->product_name); ?></option>

                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                       

                                    </select>

                                </div>
                                
                            

                                <hr width="100%" size="3" align="center" color="green" noshade>

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label><b>GOAL / เป้าหมาย</b></label>

                                        <input type="number" class="form-control" name="goal" required value="" placeholder="GOAL">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label><b>SALE / ยอดขายที่ได้</b></label>

                                        <input type="number" class="form-control" name="sale" required value="" placeholder="SALE">

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
                                
                                <th>PAGE NAME<br>ชื่อเพจ</th>

                                <th>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</th>

                                <th>GOAL / เป้าหมาย</th>

                                <th>SALE / ยอดขาย</th>

                                <th>Execute(Delete) / ลบข้อมูล</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <?php

                                $arr = explode('=',$value->page_campaign_name);

                                $page = \App\Models\Page::where('id',$arr[0])->first();

                                //  $total = 0;



                            ?>

                            <?php if(isset($page)): ?>

                                <tr>

                                    <?php

                                        $date = date('d/m/Y', strtotime($value->sale_date))

                                    ?>

                                    <th><?php echo e($date); ?></th>

                                    <td><div class="d-flex align-items-center">

                                        <?php if(!empty($page->image)): ?>

                                            <img src="<?php echo e(!empty($page->image) ? asset('storage/'.$page->image) : '/assets/images/avatar/1.jpg'); ?> " class="rounded-lg mr-2" width="24" alt=""/> 

                                        <?php endif; ?>

                                        <span class="w-space-no"><?php echo e($page->name); ?></span></div></td>

                                    <td><?php echo e($value->page_campaign_name); ?></td>

                                    <td><?php echo e($value->goal); ?></td>

                                    <td><?php echo e($value->sale); ?></td>

                                    <td><a href="<?php echo e(route('sales.destroy',$value->id)); ?>" onclick="return confirm('Are you Sure?')" class="text-danger">delete</a></td>

                                </tr>

                                
                            <?php endif; ?>


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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/sales/index.blade.php ENDPATH**/ ?>