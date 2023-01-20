<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li class="mm-active"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false" class="mm-collapse mm-show">
                    <li><a href="<?php echo e(route('dashboard')); ?>"><b>- Dashboard</b></a></li>
                    <?php if(Auth::user()->user_type == 'admin'): ?> 
                        <li><a href="<?php echo e(route('cashflow.index')); ?>"><b>- Cashflow</b> <br>คาดการณ์รายได้</a></li>
                        <li><a href="<?php echo e(route('page.index')); ?>"><b>- Page </b><br>เพจ</a></li>
                        <li><a href="<?php echo e(route('campaign.index')); ?>"><b>- Campaign</b> <br>แคมเปญ</a></li>
                        <li><a href="<?php echo e(route('sales.index')); ?>"><b>- Sale </b><br>ยอดขาย</a></li>
                        <li><a href="<?php echo e(route('advertising.index')); ?>"><b>- Advertising </b><br>ค่าโฆษณา</a></li>
                        <li><a href="<?php echo e(route('delivery.index')); ?>"><b>- Delivery </b><br>ติดตั้งค่าส่ง</a></li>
                        <li><a href="<?php echo e(route('shipping.index')); ?>"><b>- Shipping Cost </b><br>ค่าขนส่งจริง</a></li>
                        <li><a href="<?php echo e(route('income.index')); ?>"><b>- Income </b><br>รายรับ</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><b>- Return percent</b></a>
                            <ul aria-expanded="false">
                                <li><a href="<?php echo e(route('percent.index')); ?>"><b>- Return percent By Day </b><br>เปอร์เซนต์คืนรายวัน</a></li>
                                <li><a href="<?php echo e(route('percent.create')); ?>"><b>- Return percent By Page </b><br>เปอร์เซ็นต์คืนแยกเพจ</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <?php if(!empty(Auth::user()->role) || Auth::user()->role != null): ?>
                            
                            <?php $__currentLoopData = json_decode(Auth::user()->role); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item == 'Page'): ?>
                                <li><a href="<?php echo e(route('page.index')); ?>"><b>- Page </b><br>เพจ</a></li>
                                <?php endif; ?>
                                <?php if($item == 'Cashflow'): ?>
                                <li><a href="<?php echo e(route('cashflow.index')); ?>"><b>- Cashflow </b><br>คาดการณ์รายได้</a></li>
                                <?php endif; ?>
                                <?php if($item == 'Shipping'): ?>
                                <li><a href="<?php echo e(route('shipping.index')); ?>"><b>- Shipping Cost</b><br>ค่าขนส่งจริง</a></li>
                                <?php endif; ?>    
                                <?php if($item == 'Campaign'): ?>
                                <li><a href="<?php echo e(route('campaign.index')); ?>"><b>- Campaign </b> <br>แคมเปญ</a></li>
                                <?php endif; ?>
                                <?php if($item == 'Sale'): ?>
                                <li><a href="<?php echo e(route('sales.index')); ?>"><b>- Sale </b><br>ยอดขาย</a></li>
                                <?php endif; ?>
                                <?php if($item == 'Advertising'): ?>
                                <li><a href="<?php echo e(route('advertising.index')); ?>"><b>- Advertising</b><br>ค่าโฆษณา</a></li>
                                <?php endif; ?>
                                <?php if($item == 'Delivery'): ?>
                                <li><a href="<?php echo e(route('delivery.index')); ?>"><b>- Delivery </b><br>ติดตั้งค่าส่ง</a></li>
                                <?php endif; ?>
                                <?php if($item == 'Return Percent'): ?>
                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">- Return percent</a>
                                    <ul aria-expanded="false">
                                        <li><a href="<?php echo e(route('percent.index')); ?>"><b>- Return percent By Day </b><br>เปอร์เซนต์คืนรายวัน</a></li>
                                        <li><a href="<?php echo e(route('percent.create')); ?>"><b>- Return percent By Page </b><br>เปอร์เซ็นต์คืนแยกเพจ</a></li>
                                    </ul>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>


                    <?php endif; ?>

                    
                    
                    <!-- <li><a href="<?php echo e(route('percent.index')); ?>">Return percent</a></li> -->
                    
                    <?php if(Auth::user()->user_type == 'admin'): ?> 
                        <li><a href="<?php echo e(route('users.index')); ?>"><b>- User Management </b><br>การจัดการผู้ใช้งาน</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(route('setting.index')); ?>"><b>- Profile Setting </b><br>การตั้งค่าผู้ใช้งาน</a></li>
                    
                    <li><a href="<?php echo e(route('logout')); ?>"><b>Logout </b></a></li>
                </ul>
            </li>
        </ul>
        
    </div>
</div><?php /**PATH /home/zkads/domains/zkads.com/public_html/resources/views/include/sidbar.blade.php ENDPATH**/ ?>