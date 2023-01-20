

$(function(e){

    $('.role-btn').on('click',function(){
        $(this).toggleClass('bg-primary text-white');
        // $(this).find('input[name=role]').click();
        // $('.page-input').click();
     });

     $('.description-save').on('click',function(){
         $('.text-area').html($('.note-editable').html());
     });
     
     $('.random-btn').on('click',function(){
       let rand = Math.floor(Math.random() * (99999999 - 11111111 + 1) + 11111111);
       $('input[name=campaign_id]').val('#'+rand);
     });

     $('.search-btn').on('click',function(){
        let from = $('.from-date').val();
        let to = $('.to-date').val();
         location.assign('/dashboard/percent/create?from='+from+'&to='+to);
     });
});

window.onload = function(){
    // alert()
    let n = 1;
    setInterval(function(){
        if(n==1){
            $('.note-editable').html($('.text-area').text());
        }
        n++;
    //   return false;
    },1000);
    ;
 }