$(document).ready(function(){
    $(document).on('submit','#to_do_form',function(event){
        event.preventDefault();
        if($('#task_name').val()==''){
            $('#message').html('<div class="alert alert-danger">Enter Task Details</div>');
            return false;
        }
        else{
            $('#submit').attr('disabled', 'disabled');
            $.ajax({
                url:"add_task.php",
                method:"POST",
                data:$(this).serialize(),
                success:function(data)
                {
                    $('#submit').attr('disabled', false);
                    $('#to_do_form')[0].reset();
                    $('.list-group').prepend(data);
                }
            })
        }
    });
    $(document).on('click','.list-group-item',function(){
        var task_id = $(this).data('id');
        $.ajax({
            url:"update_task.php",
            method:"POST",
            data:{task_id:task_id},
            succsess:function(data){
                $('#list-group-item-'+task_list_id).css('text-decoration','line-through');
            }
        });
    })
})