<?php $__env->startSection('header'); ?>

Cashflow / คาดการณ์รายได้

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-body">

    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                

                    <div class="col-md-8">

                        <h6 class="card-title">Please select the date you want the document<br>กรุณาเลือกวันที่คุณต้องการเอกสาร</h6>

                    </div>

                    <div class="col-md-4">

                        <form action="<?php echo e(route('cashflow.export_excel')); ?>" class="form form-inline" method="POST">

                            <?php echo csrf_field(); ?>

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2023 - 12/31/2023">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                

            </div>

           

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/admin/cashflow/index.blade.php ENDPATH**/ ?>